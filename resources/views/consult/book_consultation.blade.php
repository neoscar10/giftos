<!DOCTYPE html>
<html>

<head>
 
    
    @include('consult.css')
  

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
   
    
  </div>



  <div class="container">
    <div class="header">
        <h1>Book Consultation</h1>
        <p>Learn tennis or solve tennis-related issues</p>
    </div>
    <form id="consultancyForm" method="POST" action="{{url('upload_booking')}}">
        @csrf
        <div class="form-group">
            <label for="category">Consultation Schedules:</label>
            <select id="category" name="appointment_time" required>
                <option value="" disabled selected>Choose a Schedule</option>
                @foreach ($bookings as $booking)
                    
                    <option value="{{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i A ') }} to {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}">
                        {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i A ') }} to {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
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
    <div class="success-message" id="successMessage">
        Booking Successful! See you soon!
    </div>
</div>

  

 
</body>

</html>