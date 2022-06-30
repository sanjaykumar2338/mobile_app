<?php

namespace App\Http\Controllers\API;


use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class APIController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function products() {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'message' => 'Product List(s)',
            'data' => $products,
            'image_url' => \URL::asset('uploads')
        ], 200);
    }

    public function category() {
        $category = Category::all();
        return response()->json([
            'success' => true,
            'message' => 'Category List(s)',
            'data' => $category,
            'image_url' => \URL::asset('uploads')
        ], 200);
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['name'] =  $user->name;
   
            return response()->json(['success' => true,'message'=>'User login successfully!!!','data' => $success]);
        } 
        else{ 
            return response()->json(['success' => false,'message'=>'Unauthorised']);
        } 
    }

    public function register(Request $request){
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email'    => 'unique:users|required',
            'phone_number' => 'unique:users|required',
            'password' => 'required',
        ];

        $input     = $request->only('phone_number', 'last_name', 'first_name', 'email','password');
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
}