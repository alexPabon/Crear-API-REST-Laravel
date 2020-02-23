<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransaction;
use Illuminate\Support\Facades\DB;
use App\Repositories\VerifyBuyer;
use App\Product;



class TransactionController extends Controller
{
    protected $verifyBuyer;    
    
    public function __construct(VerifyBuyer $verifyBuyer){
        $this->middleware('auth:api')->except('index','show');
        $this->verifyBuyer = $verifyBuyer;        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        
        $json = json_encode($transactions);
        
        return response($json)->header('Content-Type','application/json');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaction $request)
    {
        
        $newTransaction = DB::transaction(function()use($request){            
                                $userId = auth()->user()->id;
                                $buyerid = $this->verifyBuyer->buyer($userId);
                                
                                if(!$buyerid)
                                    $buyerid = $this->verifyBuyer->newBuyer($userId);
                                    
                                $quantity = \Purify::clean($request->quantity_products);
                                $productId = \Purify::clean($request->product_id);
                                $productQuantity = Product::find($productId);
                                $val = $productQuantity->quantity;
                                
                                if($quantity>$val)
                                    return "Error";
                                    
                                $subtract = $val - $quantity;
                                $productQuantity->quantity = $subtract;
                                $productQuantity->update();
                                
                                $transaction = Transaction::create([
                                    'quantity_products' => $quantity,
                                    'buyer_id' => $buyerid->id,
                                    'product_id' => $productId,
                                ]);
                            
                                return $transaction;                    
                        });           
        
       
       $json = json_encode($newTransaction);
       
       return response($json)->header('Content-Type','application/json');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {   
        $transaction->product;
        $json = json_encode($transaction);
        
        return response($json)->header('Content-type','application/json');
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validate = $request->validate(['quantity_products'=>'required|integer']);
        
        $transactionUpdate = DB::transaction(function()use($request, $transaction){
                                $userId = auth()->user()->id;
                                $buyerId = $this->verifyBuyer->buyer($userId);
                                $buyerIdTransaction = $transaction->buyer_id; 
                                    
                                $inQuantity = \Purify::clean($request->quantity_products);
                                
                                $productId = $transaction->product_id;
                                $productQuantity = Product::find($productId);                                
                                
                                $val = $transaction->quantity_products;
                                $totalProducts = $productQuantity->quantity + $val;
                                
                                
                                if($inQuantity>$totalProducts || $inQuantity<0)
                                    return ['update'=>'La cantidad no corresponde a la cantidad de los productos en stock'];
                                
                                if($buyerId->id!=$buyerIdTransaction)
                                    abort(403,'No Autorizado, no puedes Eliminar esta transaccion');
                                    
                                $subtract = $totalProducts - $inQuantity;
                                $productQuantity->quantity = $subtract;
                                $productQuantity->update();
                                
                                $transaction->update([
                                    'quantity_products' => $inQuantity,                                            
                                ]);
                                
                                return $transaction;
                            }); 
                
        $json = json_encode($transactionUpdate);
        
        return response($json)->header('Content-Type','application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transactionDelete = DB::transaction(function()use($transaction){
                                $userId = auth()->user()->id;
                                $buyerId = $this->verifyBuyer->buyer($userId);
                                $buyerIdTransaction = $transaction->buyer_id;           
                                
                                $productId = $transaction->product_id;
                                $productQuantity = Product::find($productId);
                                
                                $val = $transaction->quantity_products;
                                $totalProducts = $productQuantity->quantity + $val;
                                
                                
                                if($buyerId->id!=$buyerIdTransaction)
                                    abort(403,'No Autorizado, no puedes Eliminar esta transaccion');
                                    
                                
                                $productQuantity->quantity = $totalProducts;
                                $productQuantity->update();
                                
                                $transaction->delete();
                                
                                
                                return ['delete'=>'Transaccion Eliminada'];
                            });
                
        $json = json_encode($transactionDelete);
        
        return response($json)->header('Content-Type','application/json');
    }
    
    /**
     * Display a listing of the my transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function myTransactions(){
        $userId = auth()->user()->id;
        $buyerId = $this->verifyBuyer->buyer($userId);
        $transProduct = [];
        
        if(!$buyerId)
            return response(['myTransactions'=>'vacio'])->header('Content-Type','application/json');
        
        $transactions = Transaction::where('buyer_id',$buyerId->id)->get();
        
        for ($i = 0; $i < count($transactions); $i++) {
            $transId = $transactions[$i]->id;
            $transactionProduct = Transaction::find($transId);
            $transactionProduct->product;
            $transProduct[]= $transactionProduct;
        }
        
        $json = json_encode($transProduct);
        
        return response($json)->header('Content-Type','application/json');
    }
}
