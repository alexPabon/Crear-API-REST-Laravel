<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable =['user_id'];
    
    /**
     *
     * obtiene todas las transacciones
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
    
    /**
     *
     * obtiene todos los compradores
     * @return App\User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
