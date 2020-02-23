<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CategoryProduct extends Model
{
    protected $table = "category_product";
    
    protected $hidden =['created_at','id'];
    
    protected $casts = ['updated_at'=>'date:d/m/Y'];
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }  
   
}
