<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\City; 
use App\Sector; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Product;
use App\Category;
use App\Apartment;

class UserController extends Controller 
{
    public $successStatus = 200;

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['user'] =  $user; 
            return response()->json(['isSuccess'=>true,'data'=>$success],$this->successStatus); 
        } 
        else{ 
            return response()->json(['isSuccess'=>false,'data'=>[]],401); 
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
            return response()->json(['isSuccess'=>false,'data'=>$validator->errors()],401); 
        }

        $input = $request->all(); 
        //$input->name = $request->first_name.' '.$request->last_name;
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $name = $request->first_name.' '.$request->last_name;
        User::where('id',$user->id)->update(array('name'=>$name));

        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['user'] =  $user; 

        return response()->json(['isSuccess'=>true,'data'=>$success], $this-> successStatus); 
    }

    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['isSuccess'=>true,'data' => $user], $this-> successStatus); 
    } 

     public function products() {
        $products = Product::all();
        return response()->json([
            'isSuccess' => true,
            'message' => 'Product List(s)',
            'data' => $products,
            'image_url' => \URL::asset('uploads')
        ], 200);
    }

    public function category() {
        $category = Category::all();
        return response()->json([
            'isSuccess' => true,
            'message' => 'Category List(s)',
            'data' => $category,
            'image_url' => \URL::asset('uploads')
        ], 200);
    }

    public function productbycategory($id){
        $products = Product::where('category',$id)->join('category','category.id','=','products.category')->select('products.*','category.name as category_name')->get();
        return response()->json([
            'isSuccess' => true,
            'message' => 'Product List(s) by category',
            'data' => $products,
            'image_url' => \URL::asset('uploads')
        ], 200);
    }

    public function productdetails($id){
        $products = Product::where('products.id',$id)->join('category','category.id','=','products.category')->select('products.*','category.name as category_name')->first();

        return response()->json([
            'isSuccess' => true,
            'message' => 'Product Details',
            'data' => $products,
            'image_url' => \URL::asset('uploads')
        ], 200);
    }

    public function city(){
        $city = City::all();
        
        return response()->json([
            'isSuccess' => true,
            'message' => 'City List',
            'data' => $city,
        ], 200);
    }

    public function sector($id){
        $sector = Sector::where('city',$id)->get();
        
        return response()->json([
            'isSuccess' => true,
            'message' => 'Sector List',
            'data' => $sector,
        ], 200);
    }

    public function apartment($id){
        $apartment = Apartment::where('sector',$id)->get();
        
        return response()->json([
            'isSuccess' => true,
            'message' => 'Apartment List',
            'data' => $apartment,
        ], 200);
    }

    public function save_order(Request $request){
        
    }
}