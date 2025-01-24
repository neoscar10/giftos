<?php

namespace App\Jobs;

use App\Models\Appointments;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class RevertBookingIfNotPaid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bookingId;

    /**
     * Create a new job instance.
     *
     * @param int $bookingId
     */
    public function __construct($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $booking = Booking::find($this->bookingId);
    
        if ($booking && $booking->status === 'Reserved') {
            $deleted = Appointments::where('booking_id', $booking->id)->delete();
            Log::info("Deleted appointments count: " . $deleted);
    
            $booking->status = 'Available';
            $booking->reserved_by = null;
            $booking->save();
    
            Log::info("Booking reverted to available: " . $booking->id);
        } else {
            Log::info("No booking found or status not reserved for ID: " . $this->bookingId);
        }
        
    }

}
