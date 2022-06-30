<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {        
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email'    => 'unique:users|required',
            'phone_number' => 'unique:users|required',
            'password' => 'required',
        ];

        $input = $request->only('phone_number', 'last_name', 'first_name', 'email','password');
        $validator = \Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $name = $request->first_name.' '.$request->last_name;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $password = $request->password;

        $user = User::create(['first_name' => $first_name,'last_name'=>$last_name,'name' => $name, 'email' => $email,'phone_number' => $phone_number, 'password' => \Hash::make($password)]);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success' => true,'message'=>'User register successfully!!!','data' => $user]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. 
            Please try again']);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);

    }
}