<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['name','description'];
    
    protected $hidden = ['user_id','created_at'];
    
    protected $casts = ['updated_at'=>'date:d/m/Y'];
    
    public function categoryProduct(){
        return $this->hasMany(CategoryProduct::class);
    }
}
