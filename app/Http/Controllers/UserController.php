<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
          $user = JWTAuth::user();

         return response()->json(compact('user'),200);
    }

    public function register(Request $request)
    {
        //Validate User Input
        $validator = Validator::make($request->all(),[
            'firstname'=>'required|string|max:255',
            'lastname'=>'required|string|max:255',
            'username'=>'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number'=> 'required|unique:users',
            'password' => 'required|string|min:6',
             ]
        );

        if( $validator->fails()){
            return response()->json(['error'=> $validator->errors()],200);
        }
        $user = User::create([
            'lastname'=>$request->lastname,
            'firstname'=>$request->firstname,
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'phone_number'=>$request->phone_number
            ]
        );

        $token = JWTAuth::fromUser($user);
        if(!$token){
            return response()->json(['error'=>'an error occured while creating user'],500);
        }

        return response()->json(compact('user','token'),201);

    }


     public function login(Request $request)
    {
        $credentials = $request->all();
       if(!$token = auth()->attempt($credentials)){
            return response()->json(['error'=>'Invalid username or password'],501);
       }
       $user =  auth()->user();

        return response()->json(compact('user','token'),200);
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
