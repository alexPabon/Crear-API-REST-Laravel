<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable =['user_id']; 
    
    protected $hidden = ['created_at','updated_at'];
    
    /**
     *
     * obtiene todos los productos
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function product(){
        return $this->hasMany(Product::class);
    }   
   
}
