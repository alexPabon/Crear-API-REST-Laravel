<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Repositories\VerifyUser;

class UserController extends Controller
{    
    protected $verifyUser;
    
    public function __construct(VerifyUser $verifyUser){
        $this->middleware('auth:api')->except('store','index','show');        
        $this->verifyUser = $verifyUser;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $verify = $this->verifyUser->userEmail();
        
        if($verify)
            return json_encode(['email'=>'Ya existe este email']);

        $registrarUsuario = request()->validate([
            'name'=>'required|string|min:3|max:55',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        
        $nuevoUser = new User;
        $nuevoUser->name = $request->name;
        $nuevoUser->email = $request->email;
        $nuevoUser->password = Hash::make($request->password);
        $nuevoUser->api_token= Str::random(80);
        
        if(!$nuevoUser->save())
            return "No se ha pidido registrar el usuario";
        
        $json = json_encode(['token'=>$nuevoUser->api_token]);

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
        $verify = $this->verifyUser->userUpdate()->isNotEmpty();

        if($verify)
            return json_encode(['email'=>'Ya existe este email']);
        
            return "dfasdf";

        // if($verify)
        //     return json_encode(['email'=>'Ya existe este email']);

        // $request->user()->name = $request->name;
        // $request->user()->email = $request->email;
        // $request->user()->updte();

        // $json = json_encode($request->user());

        // return response($json)->header('Content-Type','application/json');         
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
        $token = $request->user()->api_token = Str::random(80); 
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
        //
    }
        
}
