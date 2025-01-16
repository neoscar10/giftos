<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductPaymentMail;
use App\Mail\BookingPaymentMail;

class PayPalController extends Controller
{
    private $gateway;

    public function __construct(){
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request, $total, $type, $booking_id = null){
        try {
            $response = $this->gateway->purchase([
                'amount' => $total,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success') . '?type=' . $type . '&booking_id=' . $booking_id,
                'cancelUrl' => url('error'),
            ])->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }   
    }

    
    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            try {
                $transaction = $this->gateway->completePurchase([
                    'payer_id' => $request->input('PayerID'),
                    'transactionReference' => $request->input('paymentId'),
                ]);
    
                $response = $transaction->send();
    
                if ($response->isSuccessful()) {
                    $arr = $response->getData();
                    $type = $request->query('type');
                    $booking_id = $request->query('booking_id');
    
                    $name = Auth::user()->name;
                    $email = Auth::user()->email;
    
                    if ($type == 'product') {
                        $address = Auth::user()->address;
                        $phone = Auth::user()->phone;
                        $userid = Auth::user()->id;
                        $cartData = Cart::where('user_id', $userid)->get();
    
                        foreach ($cartData as $data) {
                            $order = new Order();
                            $order->user_id = $userid;
                            $order->name = $name;
                            $order->rec_address = $address;
                            $order->phone = $phone;
                            $order->product_id = $data->product_id;
                            $order->payment_status = "Paid";
                            $order->qnty = $data->quantity;
                            $order->save();
                        }
    
                        // Send ProductPaymentMail
                        Mail::to($email)->send(new ProductPaymentMail($cartData));
    
                        // Clear cart
                        Cart::where('user_id', $userid)->delete();
    
                        return redirect('mycart')->with('success', 'Order placed successfully!');
                    } elseif ($type == 'booking') {
                        $booked_slot = Booking::find($booking_id);
                        $booked_slot->status = 'Booked';
                        $booked_slot->save();
    
                        // Send BookingPaymentMail
                        Mail::to($email)->send(new BookingPaymentMail($booked_slot));
    
                        return redirect('/')->with('success', 'Payment successfully made for booking!');
                    }
                } else {
                    return redirect('/')->with('error', $response->getMessage());
                }
            } catch (\Exception $e) {
                return redirect('/')->with('error', $e->getMessage());
            }
        } else {
            return redirect('/')->with('error', 'Payment declined.');
        }
    }
    

    public function error(){
        return redirect('/')->with('error', 'Payment was canceled.');
    }
}
