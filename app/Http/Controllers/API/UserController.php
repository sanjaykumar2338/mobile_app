<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Product;
use App\Category;

class UserController extends Controller 
{
    public $successStatus = 200;

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success,'user'=>$user], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'phone_number' => 'unique:users,phone_number|required', 
            'email' => 'unique:users,email|required',
            'password' => 'required', 
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        //$input->name = $request->first_name.' '.$request->last_name;
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $name = $request->first_name.' '.$request->last_name;
        User::where('id',$user->id)->update(array('name'=>$name));

        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success,'user'=>$user], $this-> successStatus); 
    }

    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
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
}