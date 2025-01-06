<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use App\Models\Order;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    //
    public function view_category(){
        $data = Category::all();

        return view("admin.category", compact("data"));
    }

    public function add_category(Request $request){
        $category = new Category();

        $category->category_name = $request->category;
        $category->save();

        toastr()->addSuccess("Category added successfully");
        
        return redirect()->back()->with("success","Successfully added catecory");
       
    }

    public function delete_category($id){
        $category = Category::find($id);
        $category->delete();
        toastr()->addSuccess(" $category->category_name deleted");
        return redirect()->back()->with("success","Category deleted");
    }

    public function edit_category($id){

        $data = Category::find($id);
        return view("admin.edit_category", compact("data"));

    }

    public function update_category(Request $request ,$id){
    $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();

        return redirect("/view_category")->with("success","Category updated");

    }

    public function add_product(){
        $category = Category::all();
        return view("admin.add_product", compact("category"));
    }

    public function upload_product(Request $request){
        $data= new Products;

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        $image = $request->image;
        if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products', $imageName);
            $data->image = $imageName;
        }

        $data->save();

        return redirect()->back()->with("success","Product added");

    }

    public function view_product(){
        $products = Products::paginate(10);

        return view("admin.view_products", compact("products"));
    }

    public function delete_product($id){
        $product = Products::find($id);

        $image_path = public_path('products/'.$product->image);

        if (file_exists($image_path)){
            unlink($image_path);
        }

        $product->delete();
        return redirect()->back()->with("success","Product deleted");
    }

    public function update_product($id){

        $data = Products::find($id);
        $category = Category::all();

        return view("admin.edit_product", compact("data", "category"));
    }

    public function edit_product(Request $request, $id){
        $product = Products::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $image = $request->image;

        if($image){
            $imageName = time().".".$image->getClientOriginalExtension();
            $request->image->move('products', $imageName);
            $product->image = $imageName;
        }
        $product->save();
        return redirect('/view_product')->with('success','Product successfully updated');
    }

    public function product_search(Request $request){
        $search = $request->search;

        $products = Products::where('title','LIKE','%'.$search.'%')->orWhere('category','LIKE','%'.$search.'%')->paginate(3);

        return view('admin.view_products', compact('products'));
    }

    public function view_orders(){
        $orders = Order::all();
        return view('admin.view_orders', compact('orders'));
    }

    public function delivered_orders(){
        $orders = Order::where('status', 'Delivered')->get();
        return view('admin.delivered_orders', compact('orders'));
    }

    public function not_delivered(){
        $orders = Order::where('status', 'On the way')->orWhere('status', 'in progress ')->get();
        return view('admin.not_delivered', compact('orders'));
    }

    

    public function view_admins(){
        $admins = User::where('usertype', 'admin')->get();

        return view('admin.view_admins', compact('admins'));
    }

    public function view_users(){
        $users = User::where('usertype', 'user')->get();

        return view('admin.view_users', compact('users'));
    }

    public function on_the_way($id){
        $order = Order::find($id);
        $order->status = 'On the way';
        $order->save();

        return redirect()->back();
    }

    public function delivered($id){
        $order = Order::find($id);
        $order->status = 'Delivered';
        $order->save();
        return redirect()->back();
    }

    //Admin functions for consultancy
    
    public function add_time_slot(Request $request){
        $slot = new Booking();

        $slot->user_id = Auth::user()->id;
        $slot->start_time = $request->start_time;
        $slot->end_time = $request->end_time;

        $slot->save();
        return redirect()->back()->with('success', 'Successfully added time slot');
    }

    public function view_appointments(){
        $appointments = Appointments::all();
        return view('admin.view_appointments', compact('appointments'));
    }

    

    

    // $category = new Category();

    //     $category->category_name = $request->category;
    //     $category->save();

    //     toastr()->addSuccess("Category added successfully");
        
    //     return redirect()->back()->with("success","Successfully added catecory");


    

    public function download_ppdf($id){
        $data = Order::find($id);

        $pdf = Pdf::loadView('admin.invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }

    
    
}
