<?php

namespace App\Http\Controllers;

use App\Jobs\RevertBookingIfNotPaid;
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

        
    
        if (!$data || $data->status !== 'Available') {
            return redirect()->back()->with('error', 'The selected slot is no longer available.');
        }
    
        $user = Auth::user();

        // updating the time slot selected to now have a reserved by field populated
        $data->reserved_by = $user->id;

        $appointment->user_id = $user->id;
        $appointment->appointment_time = Carbon::parse($data->start_time)->format('F j, Y, g:i A') . ' to ' . \Carbon\Carbon::parse($data->end_time)->format('h:i A');
        $appointment->meeting_mode = $request->meeting_mode;
        $appointment->phone = $user->phone;
        $appointment->email = $user->email;
    
        $appointment->save();
    
        // Mark the slot as Reserved
        $data->status = "Reserved";
        $data->save();
    
        // Dispatch the job to revert the status after 5 minutes
        RevertBookingIfNotPaid::dispatch($data->id)->delay(now()->addMinutes(5));
        
    
        // Send email
        Mail::to($user->email)->send(new BookingConfirmation($appointment));
    
        session()->flash('success', 'Your booking was successful!');
        Log::info(session()->all());
    
        return redirect("make_booking_payment/$selected_time_slot");
    }
    

    public function make_booking_payment($booking_id){
        //RIGIDLY DEFINING BOOKING AMOUNT
        $total = 20;
        return view('consult.make_booking_payment', compact('booking_id', 'total'));
    }

    public function test(){
        return view('consult.test');
    }

    public function manage_time_slots(){
        $data = Booking::orderBy('created_at', 'DESC')->get();
        return view('consult.manage_time_slots', compact('data'));
    }

    public function delete_time_slot($id){
        $slot = Booking::find($id);
        $slot->delete();
        return redirect()->back()->with("success","Slot deleted");
    }

    public function edit_time_slot($id){

        $data = Booking::find($id);
        return view("consult.edit_time_slot", compact("data"));

    }

    public function update_time_slot(Request $request ,$id){
        $data = Booking::find($id);
            $data->start_time = $request->start_time;
            $data->end_time = $request->end_time;
            $data->save();
    
            return redirect("/manage_time_slots")->with("success","Slot updated");
    
        }
}
