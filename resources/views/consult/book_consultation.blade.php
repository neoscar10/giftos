<!DOCTYPE html>
<html>

<head>
    @include('consult.css')
    <style>
        .back-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    text-decoration: none;
    color: #fff;
    background: #3a89e2;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background 0.3s ease, transform 0.3s ease;
}
.back-btn:hover {
    background: #2f78c9;
    transform: scale(1.05);
}
.back-btn i {
    font-size: 18px;
}

    </style>
</head>

<body>
    <a href="/" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>
    <div class="hero_area"></div>
    <div class="container">
        <div class="header">
            <h1>Book Consultation</h1>
            <h3 >A session costs <span style="color: rgb(25, 158, 80)">$20</span></h3>
            <p>Learn tennis or solve tennis-related issues</p>
        </div>

        <!-- Form for booking -->
        <form id="consultancyForm" method="POST" action="{{ url('upload_booking') }}">
            @csrf
            <div class="form-group">
                <label for="category">Consultation Schedules:</label>
                <select id="category" name="appointment_time_id" required>
                    <option value="" disabled selected>Choose a Schedule</option>
                    @foreach ($bookings as $booking)
                        <option value="{{ $booking->id }}">
                            {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i A') }} to 
                            {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="time">Meeting Mode:</label>
                <select id="time" name="meeting_mode" required>
                    <option value="" disabled selected>Select meeting mode</option>
                    <option value="Physical">Physical</option>
                    <option value="Video Call">Video Call</option>
                    <option value="Phone Call">Phone Call</option>
                </select>
            </div>
            <button type="submit" class="btn-book">Book Now</button>
        </form>

       
    </div>
</body>

</html>
