<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
      body {
          background-color: #2c3e50;
          color: #ecf0f1;
          font-family: Arial, sans-serif;
      }

      .form-container {
          margin: 50px auto;
          background-color: #34495e;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
          width: 500px;
          text-align: center;
      }

      .form-container h1 {
          margin-bottom: 20px;
          color: #1abc9c;
      }

      .form-container input[type="text"] {
          width: 80%;
          height: 50px;
          padding: 10px;
          border: 1px solid #7f8c8d;
          border-radius: 5px;
          margin-bottom: 20px;
          background-color: #2c3e50;
          color: #ecf0f1;
      }

      .form-container input[type="text"]:focus {
          border-color: #1abc9c;
          outline: none;
          box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
      }

      .form-container .btn-primary {
          background-color: #1abc9c;
          border: none;
          padding: 10px 20px;
          color: white;
          font-size: 18px;
          font-weight: bold;
          border-radius: 5px;
          cursor: pointer;
      }

      .form-container .btn-primary:hover {
          background-color: #16a085;
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="form-container">
        <h1>Update Time Slot</h1>
        <form action="{{url('update_time_slot', $data->id)}}" method="POST">
          @csrf
          <label for="birthdaytime">Schedule Begins at:</label>
          <input placeholder="Starts at..." type="datetime-local" id="dateTime" name="start_time" required><br><br>
          <label for="birthdaytime">Schedule Ends at:</label>
          <input placeholder="ends at..." type="datetime-local" id="dateTime" name="end_time" required><br><br>
          <br />
          <input
            type="submit"
            class="btn-primary"
            value="Update Time Slot"
          />
        </form>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>
