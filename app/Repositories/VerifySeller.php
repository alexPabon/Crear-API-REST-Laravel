<?php

namespace App\Repositories;
use App\User;
use App\Seller;

class VerifySeller{    
    
    public function __construct(){       
        
    }  
    
    /*
     * Comproeba que el exista el vendedor
     * @return App\Seller
     */
    public function seller(int $userId){      
        
        $user = User::find($userId);
        $seller = $user->seller;
        
        return $seller;        
    }
    
    /*
     * Crear nuevo seller
     * @return App\Seller
     */
    public function newSeller(int $userId){
        
        $newSeller = new Seller();
        $newSeller->user_id = $userId;
        $newSeller->save();
        
        return $this->seller($userId);
    }
}