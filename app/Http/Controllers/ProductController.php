<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use Illuminte\Support\Facades\Auth;
use App\Repositories\VerifySeller;


class ProductController extends Controller
{
    protected $verifySeller;
    
    public function __construct(VerifySeller $verifySeller){
        $this->middleware('auth:api')->except('index','show','productsSellers');        
        $this->verifySeller = $verifySeller;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $productos = Product::all();
        //$productos = Product::find(6);
        //$productos = Product::find([27,30]); 
        //$productos = Product::findOrFail(6000);
        //$productos = Product::where('seller','>',140)->get();
        //$productos = Product::where('seller',105)->get();
        
        $json = json_encode($productos);
          
        //return $productos;
        //return $productos->toJson();
        //return $productos->toJson(JSON_PRETTY_PRINT);
        //return json_encode($productos);
        
        return response($json)->header('Content-Type','application/json');       
      
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {           
                
        $userId = auth()->user()->id;
        $seller = $this->verifySeller->seller($userId);
        
        if(is_null($seller))
            $seller = $this->verifySeller->newSeller($userId);            
        
        $product = new Product();
        $product->name = trim(\Purify::clean($request->name));
        $product->description = trim(\Purify::clean($request->description));
        $product->quantity = \Purify::clean($request->quantity);
        $product->status = trim(\Purify::clean($request->status));
        $product->seller_id = $seller->id;
        
        $mensaje = ['store'=>'Guardado Correctamente'];
        
        if(!$product->save())
            $mensaje = ['store'=>'No se gurado el podructo'];
        
        $json = json_encode($mensaje);
        
        return response($json)->header('Content-Type','application/json');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {   
        $productoId = Product::find($product->id);
        $json = json_encode($productoId);
        
        return response($json)->header('Content-Type','application/json');              
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, Product $product)
    {
        $userId = auth()->user()->id;
        $seller = $this->verifySeller->seller($userId);
        $sellerId = $seller->id;        
        
        if($product->seller_id!=$sellerId)
            abort('403','No Autorizado, No puedes editar este producto');
        
        $product->name = trim(\Purify::clean($request->name));
        $product->description = trim(\Purify::clean($request->description));
        $product->quantity = \Purify::clean($request->quantity);
        $product->status = trim(\Purify::clean($request->status));
        $product->seller_id = $seller->id;
        
        $mensaje = ["update"=>"Actualizacion correcta"];
        
        if(!$product->update())
            $mensaje = ["update"=>"No se pudo actualizar"];
        
        $json = json_encode($mensaje);
        
        return response($json)->header('Content-Type','application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $userId = auth()->user()->id;
        $seller = $this->verifySeller->seller($userId);        
        $sellerId = $seller->id;        
        
        if($product->seller_id!=$sellerId)
            abort('403','No Autorizado, No puedes Borrar este producto');
        
        $product->delete();
        
        $mensaje = ["delete"=>"Borrado correcto"];
        $json = json_encode($mensaje);
        
        return response($json)->header('Content-Type','application/json');        
    }
    
    /*
     * Muestra todos los productos que ha publicado el usuario
     * @return \Illuminate\Http\Response
     */
    public function myproducts(){
        
        $userId = auth()->user()->id;        
        $seller = $this->verifySeller->seller($userId);
        
        if(is_null($seller))
            return json_encode(["products"=>"No tienes productos"]);
        
        $products = $seller->product;
        $json = json_encode($products);
        
        return response($json)->header('Content-Type','application/json');        
    }
    
    /*
     * Mustra todos los productos con sus vendedores
     * @return \Illuminate\Http\Response
     */
    public function productsSellers(){
        
        $sellers = Seller::all('user_id');
        $productos=[];
        
        for ($i = 0; $i < count($sellers); $i++) {
            $prod = User::find($sellers[$i]->user_id);
            $prod->seller->product;
            
            $productos[]=$prod;
        }
        
        $json = json_encode($productos);
        
        return response($json)->header('Content-Type','application/json');
        
    }
}
