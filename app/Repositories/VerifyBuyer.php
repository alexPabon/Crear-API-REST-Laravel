<?php

namespace App\Repositories;

use App\User;
use App\Buyer;

class VerifyBuyer{
    
    /*
     * Comproeba que el exista el comprador
     * @return App\Buyer
     */
    public function buyer(int $userId){
        
        $user = User::find($userId);
        $buyer = $user->buyer;
        
        return $buyer;
    }
    
    /*
     * Crear nuevo buyer
     * @return App\Buyer
     */
    public function newBuyer(int $userId){
        
        $newBuyer = new Buyer();
        $newBuyer->user_id = $userId;
        $newBuyer->save();
        
        return $this->buyer($userId);
    }
}