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
   protected $casts =['created_at'=>'date:d-m-Y'];  
}
 