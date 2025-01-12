<!DOCTYPE html>
<html>

<head>
    @include('consult.css')
    @include('home.css')
</head>

<body>
    
    <div class="container" style="width: 500px">
        <div class="header">
            <h1>Time Slot Reserved</h1>
            <p>Make Payment within 5 minutes or reservation will be revoked</p>
        </div>

        <div class="justify-content-space-between">
            <a class="btn btn-secondary" href="{{url('stripe')}}">Pay later</a>
            <a class="btn btn-success" href="{{ url('stripe', ['total' => $total, 'type' => 'booking', 'booking_id' => $booking_id]) }}">Pay with Card</a>
            <a class="btn btn-success" href="{{ url('pay', ['total' => $total, 'type' => 'booking', 'booking_id' => $booking_id]) }}">Pay with PayPal</a>

        </div>
       
        
       

       
    </div>
</body>

</html>
