<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable =['user_id']; 
    
    public function product(){
        return $this->hasMany(Product::class);
    }
   
}
