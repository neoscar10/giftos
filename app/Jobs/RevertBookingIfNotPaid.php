<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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

        // Check if the booking is still reserved
        if ($booking && $booking->status === 'Reserved') {
            $booking->status = 'Available';
            $booking->save();
        }
    }
}
