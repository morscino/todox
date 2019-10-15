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
        //
    }

    public function register(Request $request)
    {
        //Validate User Input
        $validator = Validator::make($request->all(),[
            'firstname'=>'required|string|max:255',
            'lastname'=>'required|string|max:255',
            'username'=>'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number'=> 'required|integer|unique:users',
            'password' => 'required|string|min:6',
             ]
        );

        if( $validator->fails()){
            return response()->json(['error'=> $validator->errors()],400);
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

        return response()->json(compact('token'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
