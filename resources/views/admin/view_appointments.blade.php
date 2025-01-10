<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
      .form-container {
          background-color: #2c3e50;
          padding: 10px;
          border-radius: 10px;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
          color: #ecf0f1;
          text-align: center;
      }

      .form-container input[type="text"] {
          background-color: #34495e;
          border: 1px solid #7f8c8d;
          color: #ecf0f1;
          width: 300px;
          height: 50px;
          margin-right: 10px;
          padding: 2px;
      }

      .form-container input[type="datetime-local"]:focus {
          border-color: #1abc9c;
          outline: none;
          box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
      }

      .table-container {
          margin-top: 50px;
      }

      .table-container table {
          border-collapse: collapse;
          width: 100%;
          margin: auto;
          text-align: center;
          background-color: #34495e;
      }

      .table-container th,
      .table-container td {
          padding: 15px;
          border: 1px solid #7f8c8d;
      }

      .table-container th {
          background-color: #1abc9c;
          color: white;
          font-weight: bold;
      }

      .table-container td {
          color: #ecf0f1;
      }

      .table-container a {
          text-decoration: none;
      }

      .btn-primary {
          background-color: #1abc9c;
          border-color: #16a085;
      }

      .btn-primary:hover {
          background-color: #16a085;
      }

      .btn-danger:hover {
          background-color: #e74c3c;
      }
      .pagination{
        margin-top: 15px;
        display: flex;
        align-items: center;
        justify-content: center; 
      }
      .heading{
        margin-top: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
    </style>
  </head>

  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <h1 class="heading">Appointments</h1>
      <div class="container mt-5">
        <!-- Category Table -->
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Meeting Schedule</th>
                <th>Booking Date</th>
                <th>Meeting Mode</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Payment Status</th>
                <th>Delete</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($appointments as $appointment)
                <tr>
                  {{-- {{\Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i A ')}} --}}
                  <td>{{$appointment->user->name}}</td>
                  <td>{{$appointment->appointment_time}}</td>
                  <td>{{\Carbon\Carbon::parse($appointment->created_at)->format('F j, Y, g:i A ')}}</td>
                  <td>{{$appointment->meeting_mode}}</td>
                  <td>{{$appointment->user->phone}}</td>
                  <td>{{$appointment->user->email}}</td>
                  <td>{{$appointment->payment_status}}</td>
                  <td>
                    <a class="btn btn-danger" href="{{url('delete_appointment', $appointment->id)}}" onclick="confirmation(event)">
                      <i class="fas fa-trash"></i> Delete
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
               <!-- Pagination -->
       <div class="pagination">
        {{$appointments->onEachSide(1)->links()}}
      </div>
      </div>
    </div>

    @include('admin.js')

    <script>
      function confirmation(event) {
          if (!confirm("Are you sure you want to delete appointment?")) {
              event.preventDefault();
          }
      }
    </script>
  </body>
</html>
