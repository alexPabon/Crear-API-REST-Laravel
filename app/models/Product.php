<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use App\User;
use App\Seller;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
   protected $fillable =['name','description','quantity','status','seller_id'];
   //protected $visible=['name','description','quantity','seller'];
   protected $hidden =['created_at'];
   protected $casts =['updated_at'=>'date:d/m/Y'];
   
   /**
    *
    * obtiene la relacion todas catagorias con el producto
    * @return Illuminate\Database\Eloquent\Collection
    */
   public function categoryProduct(){
       return $this->hasMany(CategoryProduct::class);
   }
   
   /**
    *
    * obtiene todos los productos
    * @return App\Seller
    */
   public function seller(){
       return $this->belongsTo(Seller::class);
   }
   
   /**
    *
    * obtiene todos los productos
    * @return Illuminate\Database\Eloquent\Collection
    */
   public function transaction(){
       return $this->hasMany(Transaction::class);
   }
}
 