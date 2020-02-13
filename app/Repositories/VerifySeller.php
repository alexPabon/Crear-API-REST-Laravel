<?php

namespace App\Repositories;
use App\User;
use App\Seller;
use Illuminate\Http\Request;

class VerifySeller{
    
    public function __construct(Request $request){        
        $this->request = $request;
        
    }
    
    /*
     * Comproeba que el exista el vendedor
     * @return App\Seller
     */
    public function seller(){
        $myToken = $this->request->bearerToken();
        $userId = User::where('api_token',$myToken)->get()->modelKeys();
        $user = User::find($userId[0]);
        $seller = $user->seller;
        
        return $seller;
        //return "venderores numeros";
    }
    
    /*
     * Crear nuevo seller
     * @return App\Seller
     */
    public function newSeller(){
        $myToken = $this->request->bearerToken();
        $userId = User::where('api_token',$myToken)->get()->modelKeys();
        
        $newSeller = new Seller();
        $newSeller->user_id = $userId[0];
        $newSeller->save();
        
        return $this->seller();
    }
}