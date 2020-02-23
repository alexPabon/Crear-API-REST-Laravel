<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable =['quantity_products','buyer_id','product_id'];
    
    protected $hidden = ['created_at'];
    
    protected $casts = ['updated_at'=>'date:d/m/Y'];
    
    /**
     *
     * obtiene el producto
     * @return App\Product
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    /**
     *
     * obtiene el comprador
     * @return App\Buyer
     */
    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
}
