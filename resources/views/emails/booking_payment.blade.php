<!DOCTYPE html>
<html>
<head>
    <title>Booking Payment Confirmation</title>
</head>
<body>
    <h1>Payment Confirmation for Your Booking</h1>
    <p>Dear {{ Auth::user()->name }},</p>
    <p>We have successfully received your payment for the following booking:</p>

    <table border="1" style="width: 100%; border-collapse: collapse;">
        <tr>
            <th>Booking ID</th>
            <td>{{ $booking->id }}</td>
        </tr>
        <tr>
            <th>Booked Slot</th>
            <td>{{ $booking->slot }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $booking->date }}</td>
        </tr>
        <tr>
            <th>Time</th>
            <td>{{ $booking->time }}</td>
        </tr>
        <tr>
            <th>Amount Paid</th>
            <td>${{ number_format($booking->amount, 2) }}</td>
        </tr>
    </table>

    <p>Your booking is confirmed. If you need to make changes or have any inquiries, please contact our support team.</p>

    <p>Thank you for choosing our service!</p>
</body>
</html>
