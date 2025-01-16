<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('home.css')
</head>

<body>
    <div class="hero_area">
        <!-- Header Section -->
        @include('home.header')

        <div class="container my-5">
            <h2 class="text-center mb-4">Payment Notifications</h2>

            @if ($notifications->isEmpty())
                <div class="alert alert-info text-center">
                    <strong>No notifications available.</strong>
                </div>
            @else
                @foreach ($notifications as $notification)
                    <div class="alert alert-warning shadow-sm rounded mb-4">
                        <p class="mb-2">
                            <strong>Appointment notification:</strong> You have an Appointment scheduled for 
                            <span class="text-primary">
                                {{ \Carbon\Carbon::parse($notification->end_time)->format('F j, Y, g:i A') }}
                            </span> to 
                            <span class="text-primary">
                                {{ \Carbon\Carbon::parse($notification->start_time)->format('F j, Y, g:i A') }}
                            </span>.
                        </p>
                        <p>Payment status for the reservation is <strong>{{$notification->payment_status}}</strong></p>
                        
                        @if ($notification->payment_status == "unpaid")
                            <div class="justify-content-space-between">
                                <a class="btn btn-success" href="{{ url('stripe', ['total' => $total, 'type' => 'booking', 'booking_id' => $booking_id]) }}"><i class="fa-duotone fa-solid fa-credit-card"></i> Pay with Card</a>
                                <a class="btn btn-primary" href="{{ url('pay', ['total' => $total, 'type' => 'booking', 'booking_id' => $booking_id]) }}"><i class="fa-brands fa-paypal"></i> Pay with PayPal</a>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Footer Section -->
        @include('home.footer')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
