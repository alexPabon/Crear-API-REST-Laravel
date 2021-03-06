<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUser;
use Illuminte\Support\Facades\Auth;

class UserController extends Controller
{ 
    
    public function __construct(){
        $this->middleware('auth:api')->except('store','index','show'); 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $usuarios = User::all();
        $json = json_encode($usuarios);
        
        return response($json)->header('Content-Type','application/json');
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {           
        
        $newUser = new User;
        $newUser->name = trim(\Purify::clean($request->name));
        $newUser->email = trim(\Purify::clean($request->email));
        $newUser->password = Hash::make($request->password);
        $newUser->api_token= Str::random(80);        
        
        if(!$newUser->save())
            return 'No se ha pidido registrar el usuario';
        
        $json = json_encode(['token'=>$newUser->api_token]);

        return response($json)->header('Content-Type','application/json');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $json = json_encode($user);
        return response($json)->header('Content-Type','application/json');                
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(auth()->user()->id != $user->id)
            abort('403','No Autorizado, No puedes editar este Usuario');
        
        $myEmail = auth()->user()->email;
        $newEmail = $request->email;
        
        $validate = $request->validate(['name'=>'required|string|min:3|max:55',]);
        
        if($myEmail != $newEmail)
            $validate = $request->validate([
                'name'=>'required|string|min:3|max:55',
                'email' => 'required|string|email|max:255|unique:users',
            ]);  
        
        $clean = \Purify::clean($validate);
        
        $user->update($clean);

        $json = json_encode($user);

        return response($json)->header('Content-Type','application/json');        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function cambiarToken(Request $request)
    {         
        $request->user()->api_token = Str::random(80); 
        $request->user()->update();

        return redirect()->route('home');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user()->id != $user->id)
            abort('403','No Autorizado, No puedes Borrar este Usuario');
        
        $mensaje = ["delete"=>"Borrado correcto"];

        if(!$user->delete())
            $mensaje = ["delete"=>"No se pudo Borrar"];        
        
        $json = json_encode($mensaje);
        
        return response($json)->header('Content-Type','application/json');        
    }
        
}
