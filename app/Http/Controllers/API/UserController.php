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
use App\Order;
use App\OrderItems;
use Carbon\Carbon;

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

    public function update_profile(Request $request) { 
        $user = Auth::user();
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'phone_number' => 'required|unique:users,phone_number,'.$user->id, 
            'email' => 'required|unique:users,email,'.$user->id
        ]);

        if ($validator->fails()) { 
            return response()->json(['isSuccess'=>false,'data'=>$validator->errors()],401); 
        }

        if($request->password){
            User::where('id',$user->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => bcrypt($request->password) 
            ]);
        }else{
             User::where('id',$user->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email
            ]);
        }        

        $user = Auth::user();
        return response()->json(['isSuccess'=>true,'data'=>$user],200); 
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

     public function products(Request $request) {
        
        if($request->name){
            $products = Product::where('name', 'like', '%'.$request->name.'%')->get();
        }else{
            $products = Product::all();   
        }

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
        $user = Auth::user(); 
        $items = json_decode($request->getContent());

        $order = Order::create([
            'user_id' => $user->id,
            'date' => Carbon::now(),
            'address' => $items->address,
            'status' => 1,
            'city' => $items->city,
            'apartment' => $items->apartment,
            'sector' => $items->sector,
            'total' => $items->total,
            'first_name' => $items->first_name,
            'last_name' => $items->last_name,
            'phone_number' => $items->phone_number
        ]);

        $OrderItems = $items->OrderItems;
        foreach ($OrderItems as $key => $value) {           
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $value->product_id,
                'quantity' => $value->quantity,
                'price' => $value->price
            ]);
        }

        return response()->json([
            'isSuccess' => true,
            'message' => 'Order placed successfully',
            'data' => $order
        ], 200);
    }

    public function orders(Request $request){
        $user = Auth::user();
        $order = Order::where('user_id' , $user->id)->orderby('created_at','DESC')->get();

        return response()->json([
            'isSuccess' => true,
            'message' => 'Order list',
            'data' => $order
        ], 200);
    }  

    public function order_details(Request $request, $id){
        $user = Auth::user();
        $order_items = Order::where('orders.id' ,$id)->join('order_items','order_items.order_id','=','orders.id')->join('products','products.id','=','order_items.product_id')->join('city as c','c.id','=','orders.city')->join('sector as s','s.id','=','orders.sector')->join('apartment as a','a.id','=','orders.apartment')->select('order_items.*','c.name as city_name','s.name as sector_name','a.name as apartment_name','products.name as product_name','products.image as product_image','orders.address as delivery_address')->get();

        $order = Order::where('orders.id' ,$id)->first();

        return response()->json([
            'isSuccess' => true,
            'message' => 'Orders list',
            'data' => ['order'=>$order,'order_items'=>$order_items],
            'image_url' => \URL::asset('uploads')
        ], 200);
    }    
}