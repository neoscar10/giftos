<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Session;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

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
        $products = Products::orderBy('created_at', 'DESC')->get();
        // Ternary Opp---First checks if the user is authenticated? else give it a value of ''
        $count = Auth::check() ? Cart::where('user_id', Auth::user()->id)->sum('quantity') : '';
        return view("home.index", compact("products", 'count'));
    }

    public function login_home(){
        $products = Products::orderBy('created_at', 'DESC')->get();
        $count = Auth::check() ? Cart::where('user_id', Auth::user()->id)->sum('quantity') : '';
        return view("home.index", compact('products', 'count'));
    }

    public function product_details($id){
        $product = Products::find($id);
        $count = Auth::check() ? Cart::where('user_id', Auth::user()->id)->sum('quantity') : '';
        return view("home.product_details", compact("product", "count"));
    }

    public function add_cart($id)
{
    $product_id = $id;

    if (Auth::check()) {
        // If the user is authenticated
        $user_id = Auth::id();

        // Check if the product is already in the user's cart
        $existingCartItem = Cart::where('user_id', $user_id)
                                ->where('product_id', $product_id)
                                ->first();
        if ($existingCartItem) {
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $product_id;
            $data->quantity = 1;
            $data->save();
        }
    } else {
        // If the user is not authenticated, store in session
        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += 1;
        } else {
            $cart[$product_id] = [
                'product_id' => $product_id,
                'quantity' => 1,
            ];
        }
        session()->put('cart', $cart);
    }
    return redirect()->back()->with('success', 'Product added to cart');
}

public function mycart()
{
    $cartData = [];
    $count = 0;

    if (Auth::check()) {
        // Authenticated user
        $user_id = Auth::id();
        $cartData = Cart::where('user_id', $user_id)->get();
        $count = $cartData->sum('quantity');
    } else {
        // Unauthenticated user
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);

        // Fetch product details for session-based cart
        $products = Products::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $cartData[] = [
                'product' => $product,
                'quantity' => $cart[$product->id]['quantity'],
            ];
        }
        $count = array_sum(array_column($cart, 'quantity'));
    }
    return view("home.mycart", compact("count", 'cartData'));
}

    public function notification()
    {
        $cartData = [];
        $count = 0;

        if (Auth::check()) {
            // Authenticated user
            $user_id = Auth::id();
            $cartData = Cart::where('user_id', $user_id)->get();
            $count = $cartData->sum('quantity');
            $notifications = collect();
            // Total is the static fee for booking
            $total = 20;
            // slot reserved by this particular user
            $reserved_slot = Booking::where('reserved_by', $user_id)->where('status', 'Reserved')->first();
            if ($reserved_slot) {
                $booking_id = $reserved_slot->id;
                $notifications = Appointments::where('user_id', $user_id)->get();
            }else{
                $booking_id='';
                
            }
        } else {
            // Unauthenticated user
            $cart = session()->get('cart', []);
            $productIds = array_keys($cart);

            // Fetch product details for session-based cart
            $products = Products::whereIn('id', $productIds)->get();
            foreach ($products as $product) {
                $cartData[] = [
                    'product' => $product,
                    'quantity' => $cart[$product->id]['quantity'],
                ];
            }
            $count = array_sum(array_column($cart, 'quantity'));
        }
        return view("home.notification", compact("count", 'notifications', 'total', 'booking_id'));
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
            $order->qnty = $data->quantity;
            $order->save();
            // reduce quantity of a product when an order is made for it
            $bought_product = Products::find($data->product_id);
            $bought_product->quantity= $bought_product->quantity - $order->qnty;
            $bought_product->save();
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
        $count = Auth::check() ? Cart::where('user_id', Auth::user()->id)->sum('quantity') : '';
        $products = Products::all();
        return view('home.shop', compact('count', 'products'));
    }
    public function why(){
        $count = Auth::check() ? Cart::where('user_id', Auth::user()->id)->sum('quantity') : '';
             return view('home.why', compact('count'));
        }

    public function contact(){
        $count = Auth::check() ? Cart::where('user_id', Auth::user()->id)->sum('quantity') : '';
                return view('home.contact', compact('count'));
        }
    public function search(Request $request){
        $count = Auth::check() ? Cart::where('user_id', Auth::user()->id)->sum('quantity') : '';
        $search = $request->search;
        $products = Products::where('title','LIKE','%'.$search.'%')->orWhere('category','LIKE','%'.$search.'%')->paginate(3);
        return view('home.shop', compact('products', 'count'));
    }
    public function sendContactMail(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'message' => 'required|string',
        ]);

        $details = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
        ];
        // Send the email -------Edit email to needed email
        Mail::to('neoscar101@gmail.com')->send(new ContactMail($details));
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }




    //stripe integration
    public function stripe($total, $type, $booking_id=null)

    {
        return view('home.stripe', compact('total', 'type', 'booking_id'));
    }

    public function stripePost(Request $request, $total, $type, $booking_id=null)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $total * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment from Gani Clothing Line" 
        ]);

      //this particular datas are gotten from the user table and not the probarbly updated address
        $name = Auth::user()->name;
        if ($type == 'product'){
            $address = $request->address;
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
                $order->qnty = $data->quantity;
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
        }elseif ($type=='booking'){
            $booked_slot = Booking::find($booking_id);
            $booked_slot->status = 'Booked';
            $booked_slot->save();
            return redirect('/')->with('success', 'Payment successfully made');
        }       
    }
}
