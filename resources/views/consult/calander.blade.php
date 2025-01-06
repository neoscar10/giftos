<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <title>Booking Calendar</title>
</head>
<body>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true, // Allow selecting dates
                events: '/api/consultant-availability', // Backend endpoint to fetch events
                
                // Add your `dateClick` function here
                dateClick: function (info) {
                    const isConfirmed = confirm(`Do you want to book this date? ${info.dateStr}`);
                    if (isConfirmed) {
                        // Send the selected date to the backend for booking
                        fetch('/api/book-appointment', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token for Laravel
                            },
                            body: JSON.stringify({ date: info.dateStr }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message); // Display success message
                            calendar.refetchEvents(); // Reload calendar events
                        })
                        .catch(error => console.error('Error:', error));
                    }
                },
            });

            calendar.render();
        });
    </script>
</body>
</html>
