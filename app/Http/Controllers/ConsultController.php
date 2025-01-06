<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;



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

    public function upload_booking(Request $request){
        $appointment = new Appointments();
        
        $user = Auth::user();
        $appointment->user_id = $user->id;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->meeting_mode = $request->meeting_mode;
        $appointment->phone = $user->phone;
        $appointment->email = $user->email;

        $appointment->save();
        return redirect('/')->with('success', 'Appointment booked');
    }







    public function getAvailability()
    {
        // Replace this with data fetched from your database
        $events = [
            [
                'title' => 'Available Slot',
                'start' => '2025-01-06T10:00:00',
                'end' => '2025-01-06T11:00:00',
            ],
            [
                'title' => 'Unavailable',
                'start' => '2025-01-07T14:00:00',
                'end' => '2025-01-07T15:00:00',
                'color' => 'red', // Customize event appearance
            ],
        ];

        return response()->json($events);
    }

    public function test(){
        return view('consult.test');
    }

    public function manage_time_slots(){
        $data = Booking::all();
        return view('consult.manage_time_slots', compact('data'));
    }
}
