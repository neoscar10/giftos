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
    <form id="consultancyForm">
        <div class="form-group">
            <label for="category">Consultation Category:</label>
            <select id="category" required>
                <option value="" disabled selected>Select Category</option>
                <option value="Tennis Training">Tennis Training</option>
                <option value="Tennis Equipment">Tennis Equipment</option>
                <option value="Tournament Tips">Tournament Tips</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Select Date:</label>
            <input type="date" id="date" required>
        </div>
        <div class="form-group">
            <label for="time">Available Time:</label>
            <select id="time" required>
                <option value="" disabled selected>Select Time</option>
                <option value="10:00 AM">10:00 AM to 12:00 PM</option>
                <option value="2:00 PM">2:00 PM to 4:00 PM</option>
                <option value="5:00 PM">5:00 PM to 6:00 PM</option>
            </select>
        </div>
        <button type="submit" class="btn-book">Book Now</button>
    </form>
    <div class="success-message" id="successMessage">
        Booking Successful! See you soon!
    </div>
</div>
<script>
    const form = document.getElementById('consultancyForm');
    const successMessage = document.getElementById('successMessage');

    // Predefined occupied slots (date and time)
    const occupiedSlots = [
        "01-3-2025 10:00 AM to 12:00 PM"
    ];

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const category = document.getElementById('category').value;
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;
        const slot = `${date} ${time}`;

        if (occupiedSlots.includes(slot)) {
            alert('This slot is already occupied. Please select a different time or date.');
            return;
        }

        occupiedSlots.push(slot); // Mark the slot as occupied
        successMessage.style.display = 'block';
        form.reset();

        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 3000);
    });
</script>
  
  

 
</body>

</html>