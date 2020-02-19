<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\CategoryProduct;


class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except('index','show','categoryProducts');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $json = json_encode($categories);
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
        $newCategory = new Category();
        $newCategory->name = $request->name;
        $newCategory->description = $request->description;
        
        $newCategory->save();
        
        $json = json_encode($newCategory);

        return response($json)->header('Content-Type','application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $json = json_encode($category);
        
        return response($json)->header('Content-Type','application/json');
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        
        $category->update();

        $json = json_encode($category);
        
        return response($json)->header('Content-Type','application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $mensaje = ['delete'=>'Categoria Eliminada'];
        if(!$category->delete())
            $mensaje = ['delete'=>'No se elimino Categoria'];
            
        $json = json_encode($mensaje);
        
        return response($json)->header('Content-Type','application/json');
    }
    
    /**
     * Muestra todas las categorias con sus productos
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryProducts(){
        
//         $catProd = CategoryProduct::where('category_id',2)->where('product_id',4)->first();       
//         if(!is_null($catProd))
//             $catProd->product;        
       
        $categories = Category::all();       
        
        for ($j = 0; $j < count($categories); $j++) {
            $cat_product = Category::find($categories[$j]->id);
            $cat_product = $cat_product->categoryProduct;
            $all_CatProducts = [];
            for ($i = 0; $i < count($cat_product); $i++) {
                $cId = $cat_product[$i]->category_id;
                $pId = $cat_product[$i]->product_id;
                
                $catProduct = CategoryProduct::where('category_id',$cId)->where('product_id',$pId)->first();
                
                if(!is_null($catProduct))
                    $catProduct->product;
                
                $all_CatProducts[]=$catProduct;
                
            }
            
            Arr::add($categories[$j],'category_product',$all_CatProducts);
        }        
        
        $json = json_encode($categories);
        
        return response($json)->header('Content-Type','application/json');
    }
    
    /**
     * Muestra todas las categorias creadas por el usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function myCategories(){
        $userId = auth()->user()->id;
        $categories = Category::where('user_id',$userId)->get();

        $json = json_encode($categories);
        
        return response($json)->header('Content-Type','application/json');
    }
    
    /**
     * relaciona la categoria con el producto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCategoryProduct(Request $request){
        return "addCategoryProduct"; 
    }
}
