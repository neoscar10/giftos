<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #f8f9fa; padding: 20px;">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h1>Booking Confirmation</h1>
        </div>
        <div class="card-body">
            <p class="lead">Dear <strong>{{ Auth::user()->name }}</strong>,</p>
            <p class="mb-4">Your booking has been successfully scheduled.</p>
            
            <h5><strong>Booking Details</strong></h5>
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Time:</strong> {{ $appointment->appointment_time }}</li>
                <li class="list-group-item"><strong>Mode:</strong> {{ $appointment->meeting_mode }}</li>
            </ul>

            <p class="text-muted">Thank you for booking with us! We look forward to serving you.</p>
        </div>
        <div class="card-footer text-center">
            <small>&copy; {{ date('Y') }} Your Goni Clothin Line. All Rights Reserved.</small>
        </div>
    </div>
</div>

</body>
</html>
