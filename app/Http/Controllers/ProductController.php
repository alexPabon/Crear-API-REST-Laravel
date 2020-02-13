<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Seller;
use Illuminate\Http\Request;
use Illuminte\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\VerifySeller;


class ProductController extends Controller
{
    protected $verifySeller;
    
    public function __construct(VerifySeller $verifySeller){
        $this->middleware('auth:api')->except('index','show');        
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
    public function store(Request $request)
    {        
        $seller = $this->verifySeller->seller();
        
        if($seller==null)
            $seller = $this->verifySeller->newSeller();            
        
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->seller_id = $seller->id;
        
        
        if(!$product->save())
            return response('No se gurado el podruc')->header('Content-Type','application/json');
        
        return response('Guardado Correctamente')->header('Content-Type','application/json');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       
        $productoId = Product::where('id',$product->id)->get();
        
        return $productoId->toArray();
              
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $seller = $this->verifySeller->seller();
        $sellerId = $seller->id;
        if($product->seller_id!=$sellerId)
            return "No coincide producto con propietario";
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->seller_id = $seller->id;
        
        if($product->update())
            return "Actualizacion correcta";            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $seller = $this->verifySeller->seller();
        $sellerId = $seller->id;
        if($product->seller_id!=$sellerId)
            return "No coincide producto con propietario";
        
        $product->delete();
        return "Producto Eliminado";
        
    }
    
    /*
     * Muestra todos los productos que ha publicado el usuario
     */
    public function myproducts(){
        
        $seller = $this->verifySeller->seller();
        
        if($seller==null)
            return [];
        
        $product = $seller->product;
        $json = json_encode($product);
        
        return response($json)->header('Content-Type','application/json');        
    }
}
