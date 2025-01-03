<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Session;

class HomeController extends Controller
{
    //
    public function index(){
        $users = User::where('usertype', 'user')->count();
        $admins = User::where('usertype', 'admin')->count();
        $products = Products::all()->count();
        $delivered = Order::where('status','delivered')->count();
        $not_delivered = Order::where('status', 'On the way')->orWhere('status', 'in progress ')->count();
        $orders = Order::all()->count();
        return view("admin.index", compact("users", "products", "delivered", "orders", "admins", "not_delivered"));
    }

    public function home(){
        $products = Products::all();
        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
            //end of side
        } else {
            $count = '';
        }
        
        
      
        return view("home.index", compact("products", 'count'));
    }

    public function login_home(){
        $products = Products::all();

        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
            //end of side
        } else {
            $count = '';
        }
        
      

        return view("home.index", compact('products', 'count'));
    }

    public function product_details($id){
        $product = Products::find($id);

        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
            //end of side
        } else {
            $count = '';
        }
        

        return view("home.product_details", compact("product", "count"));
    }

    public function add_cart($id)
        {
            $product_id = $id;
            $user = Auth::user(); // Gets the currently authenticated user
            $user_id = $user->id;

            // Check if the product is already in the user's cart
            $existingCartItem = Cart::where('user_id', $user_id)
                                    ->where('product_id', $product_id)
                                    ->first();

            if ($existingCartItem) {
                // If the product already exists in the cart, increment the quantity
                $existingCartItem->quantity += 1; // Adjust the increment as needed
                $existingCartItem->save();
            } else {
                // Otherwise, create a new cart entry
                $data = new Cart;
                $data->user_id = $user_id;
                $data->product_id = $product_id;
                $data->quantity = 1;
                $data->save();
            }

            return redirect()->back()->with('success', 'Product added to cart');
        }


    public function mycart(){

        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
            //end of side
            $cartData = Cart::where('user_id', $userid)->get();
        } else {
            $count = '';
        }

        return view("home.mycart", compact("count", 'cartData'));
    }

    public function deleteCartIten($id){
        $item = Cart::find($id);

        $item->delete();
        return redirect()->back();
    }

    public function updateCartQuantity(Request $request, $id)
        {
            $cartItem = Cart::findOrFail($id);
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            // Calculate the new total
            $userId = $cartItem->user_id;
            $cartItems = Cart::where('user_id', $userId)->get();
            $newTotal = 0;

            foreach ($cartItems as $item) {
                $newTotal += $item->product->price * $item->quantity;
            }

            return response()->json(['success' => true, 'newTotal' => $newTotal]);
        }

    public function getCartCount()
        {
            $count = 0;
            if (Auth::id()) {
                $user = Auth::user();
                $userid = $user->id;
                $count = Cart::where('user_id', $userid)->sum('quantity');
            }
            return response()->json(['count' => $count]);
        }


    public function confirm_order(Request $request){
        $name = $request->name;
        $address = $request->address;
        $phone =   $request->phone;
        $userid = Auth::user()->id;
        $cartData = Cart::where('user_id', $userid)->get();

        foreach ($cartData as $data ){
            $order = new Order;
            $order->user_id = $userid;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $data->product_id;

            $order->save();
        }

        $cartDatas = Cart::where('user_id', $userid)->get();

        foreach ($cartDatas as $data){
            // because here each data has an id
            $dataToDelete = Cart::find($data->id);
            $dataToDelete->delete();
        }

        return redirect()->back()->with('success','Order placed');
        
    }

    public function myorders(){
        //default line for cart count data
        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');


            $orders = Order::where('user_id', $userid)->get();
            //end of side
            $cartData = Cart::where('user_id', $userid)->get();
        } else {
            $count = '';
        }
        //end.........................
        return view('home.myorder', compact('count', 'orders'));
    }

    public function shop(){
        //default line for cart count data
        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
            $products = Products::all();


            $orders = Order::where('user_id', $userid)->get();
            //end of side
            $cartData = Cart::where('user_id', $userid)->get();
        } else {
            $count = '';
            $products = Products::all();
        }
        //end.........................
        return view('home.shop', compact('count', 'products'));
    }

    
    public function why(){
        //default line for cart count data
        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
        


            $orders = Order::where('user_id', $userid)->get();
            //end of side
            $cartData = Cart::where('user_id', $userid)->get();
        } else {
            $count = '';
        }
             //end.........................
             return view('home.why', compact('count'));
        }

        public function search(Request $request){
            $search = $request->search;

            $products = Products::where('title','LIKE','%'.$search.'%')->orWhere('category','LIKE','%'.$search.'%')->paginate(3);

            return view('home.shop', compact('products'));
        }


    


















    //stripe integration
    public function stripe($total)

    {
        return view('home.stripe', compact('total'));
    }

    public function stripePost(Request $request, $total)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $total * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from Giftos" 

        ]);

      //this particular datas are gotten from the user table and not the probarbly updated address
        $name = Auth::user()->name;
        $address = Auth::user()->address;
        $phone =  Auth::user()->phone;
        $userid = Auth::user()->id;
        $cartData = Cart::where('user_id', $userid)->get();

        foreach ($cartData as $data ){
            $order = new Order;
            $order->user_id = $userid;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $data->product_id;
            $order->payment_status = "Paid";

            $order->save();
        }

        $cartDatas = Cart::where('user_id', $userid)->get();

        foreach ($cartDatas as $data){
            // because here each data has an id
            $dataToDelete = Cart::find($data->id);
            $dataToDelete->delete();
        }

        return redirect('mycart')->with('success','Order placed');

    }

}
