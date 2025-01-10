<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;



use Illuminate\Http\Request;

class ConsultController extends Controller
{
    //

    public function book_consultation(){
        $bookings = Booking::all();
        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
            //end of side
        } else {
            $count = '';
        }

        return view('consult.book_consultation', compact('count', 'bookings'));
    }

    public function upload_booking(Request $request)
        {
            $appointment = new Appointments();

            // Get the selected booking ID from available bookings
            $selected_time_slot = $request->appointment_time_id;
            $data = Booking::find($selected_time_slot);

            $user = Auth::user();
            $appointment->user_id = $user->id;
            $appointment->appointment_time = Carbon::parse($data->start_time)->format('F j, Y, g:i A') . ' to ' . \Carbon\Carbon::parse($data->end_time)->format('h:i A');
            $appointment->meeting_mode = $request->meeting_mode;
            $appointment->phone = $user->phone;
            $appointment->email = $user->email;

            $appointment->save();
            $data->status = "Reserved";
            $data->save();

            // Send email
            Mail::to($user->email)->send(new BookingConfirmation($appointment));

            session()->flash('success', 'Your booking was successful!');
            Log::info(session()->all());

            return redirect('make_booking_payment');
        }

    public function make_booking_payment(){
        return view('consult.make_booking_payment');
    }

    public function test(){
        return view('consult.test');
    }

    public function manage_time_slots(){
        $data = Booking::all();
        return view('consult.manage_time_slots', compact('data'));
    }
}
