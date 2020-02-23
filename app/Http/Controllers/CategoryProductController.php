<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryProduct;
use App\CategoryProduct;
use App\Category;
use App\Product;


class CategoryProductController extends Controller
{
    public function __construct(){
       $this->middleware('auth:api');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryProduct $request)
    {        
        $category = $request->category_id;
        $product = $request->product_id;               
        $catProduct = CategoryProduct::where('category_id',$category)->where('product_id',$product)->first();
        
        $sellerId = Product::find($product)->seller->user_id;
        $userId = auth()->user()->id;
        
        if($userId!=$sellerId)
            abort('403','No Autorizado, No puedes relacionar este producto');
        
        
        if(!$catProduct){
            
            $catProduct = new CategoryProduct();
            $catProduct->category_id = $request->category_id;
            $catProduct->product_id = $request->product_id;
            
            $catProduct->save();
        }        
        
        return $catProduct;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreCategoryProduct $request)
    {
        $category = $request->category_id;
        $product = $request->product_id;
        $categoryProduct = CategoryProduct::where('category_id',$category)->where('product_id',$product);
        
        $sellerId = Product::find($product)->seller->user_id;
        $userId = auth()->user()->id;
        
        if($userId!=$sellerId)
            abort('403','No Autorizado, No puedes relacionar este producto');
        
        $categoryProduct->delete();
        
        return "eliminado";
        
    }
}
