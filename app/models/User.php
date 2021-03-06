<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token','admin','updated_at',
        'email_verified_at','created_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'=>'date:d/m/Y',
    ];
   
    /**
     *
     * obtiene todos los vendedores
     * @return App\Seller
     */
    public function seller(){
        
        return $this->hasOne(Seller::class);
        
    }
    
    /**
     *
     * obtiene todos los compradores
     * @return App\Buyer
     */
    public function buyer(){
        return $this->hasOne(Buyer::class);
    }
}
