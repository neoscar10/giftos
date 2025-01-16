<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConsultController;

use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Middleware\Admin;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;

route::get("/", [HomeController::class,"home"])->name("home");
route::get("/dashboard", [HomeController::class,"login_home"])->middleware(['auth', 'verified'])->name('dashboard');;
Route::controller(SocialiteController::class)->group(function(){
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
    Route::get('auth/google', 'googleLogin')->name('auth.google');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


route::get('admin/dashboard', [HomeController::class,'index'])->middleware(['auth', 'admin']);

//admin controllers
route::get('view_category', [AdminController::class,'view_category'])->middleware(['auth', 'admin']);
route::post('add_category', [AdminController::class,'add_category'])->middleware(['auth', 'admin']);
route::get('delete_category/{id}', [AdminController::class,'delete_category'])->middleware(['auth', 'admin']);
route::get('delete_appointment/{id}', [AdminController::class,'delete_appointment'])->middleware(['auth', 'admin']);

//contactMail
Route::post('contactMail', [HomeController::class, 'sendContactMail'])->name('contactMail');


route::get('edit_category/{id}', [AdminController::class,'edit_category'])->middleware(['auth', 'admin']);
route::post('update_category/{id}', [AdminController::class,'update_category'])->middleware(['auth', 'admin']);
route::get('add_product', [AdminController::class,'add_product'])->middleware(['auth', 'admin']);
route::post('upload_product', [AdminController::class,'upload_product'])->middleware(['auth', 'admin']);
route::get('view_product', [AdminController::class,'view_product'])->middleware(['auth', 'admin']);
route::get('view_admins', [AdminController::class,'view_admins'])->middleware(['auth', 'admin']);
route::get('view_users', [AdminController::class,'view_users'])->middleware(['auth', 'admin']);
route::get('delete_product/{id}', [AdminController::class,'delete_product'])->middleware(['auth', 'admin']);
route::get('update_product/{id}', [AdminController::class,'update_product'])->middleware(['auth', 'admin']);
route::post('edit_product/{id}', [AdminController::class,'edit_product'])->middleware(['auth', 'admin']);
route::get('product_search', [AdminController::class,'product_search'])->middleware(['auth', 'admin']);
route::get('delivered/{id}', [AdminController::class,'delivered'])->middleware(['auth', 'admin']);
route::get('download_ppdf/{id}', [AdminController::class,'download_ppdf'])->middleware(['auth', 'admin']);
route::get('view_orders', [AdminController::class,'view_orders'])->middleware(['auth', 'admin']);
route::get('delivered_orders', [AdminController::class,'delivered_orders'])->middleware(['auth', 'admin']);
route::get('not_delivered', [AdminController::class,'not_delivered'])->middleware(['auth', 'admin']);
route::get('on_the_way/{id}', [AdminController::class,'on_the_way'])->middleware(['auth', 'admin']);

//Home controllers
route::get('product_details/{id}', [HomeController::class,'product_details']);
Route::get('add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('mycart', [HomeController::class, 'mycart'])->middleware(['auth', 'verified']);
route::get('notification', [Homecontroller::class, 'notification'])->middleware(['auth', 'verified']);
route::get('deleteCartIten/{id}', [HomeController::class,'deleteCartIten'])->middleware(['auth', 'verified']);
Route::post('/updateCartQuantity/{id}', [HomeController::class, 'updateCartQuantity']);
route::post('confirm_order', [HomeController::class,'confirm_order'])->middleware(['auth', 'verified']);
route::get('myorders', [HomeController::class,'myorders'])->middleware(['auth', 'verified']);
route::get('shop', [HomeController::class,'shop']);
route::get('why', [HomeController::class,'why']);
Route::get('/cart-count', [HomeController::class, 'getCartCount']);
route::get('search', [HomeController::class,'search']);
route::get('contact', [HomeController::class, 'contact']);

// Consultation routes
route::get('book_consultation', [ConsultController::class,'book_consultation'])->middleware('auth', 'verified');
// Route::get('/consultant-availability', [ConsultController::class, 'getAvailability']);
route::post('add_time_slot', [AdminController::class,'add_time_slot'])->middleware('auth', 'admin');
route::get('test', [ConsultController::class,'test'])->middleware('auth', 'admin');
route::get('manage_time_slots', [ConsultController::class,'manage_time_slots'])->middleware('auth', 'admin');
route::post('upload_booking', [ConsultController::class,'upload_booking'])->middleware('auth', 'verified');
route::get('view_appointments', [AdminController::class,'view_appointments'])->middleware('auth', 'admin');
route::get('make_booking_payment/{booking_id}', [ConsultController::class,'make_booking_payment'])->middleware('auth', 'verified');
route::get('delete_time_slot/{id}', [ConsultController::class,'delete_time_slot'])->middleware(['auth', 'admin']);
route::get('edit_time_slot/{id}', [ConsultController::class, 'edit_time_slot'])->middleware(['auth', 'admin']);
route::post('update_time_slot/{id}', [ConsultController::class,'update_time_slot'])->middleware(['auth', 'admin']);


// stripe payment route
Route::controller(HomeController::class)->group(function(){

    Route::get('stripe/{total}/{type}/{booking_id?}', 'stripe');
    Route::post('stripe/{total}/{type}/{booking_id?}', 'stripePost')->name('stripe.post');

});
// PayPal Payment Integration
Route::get('pay/{total}/{type}/{booking_id?}', [PayPalController::class, 'pay'])->name('pay');
Route::get('success', [PayPalController::class, 'success']);
Route::get('error', [PayPalController::class, 'error']);
