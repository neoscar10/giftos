<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')

   <style type="text/css">
    .form-container {
        background-color: #2c3e50;
        padding: 30px;
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
        padding: 10px;
    }

    .form-container input[type="text"]:focus {
        border-color: #1abc9c;
        outline: none;
        box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
    }

    .table-container {
        margin-top: 50px;
    }

    .table-container table {
        border-collapse: collapse;
        width: 80%;
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
        background-color:#273646;
        color: white;
        font-weight: bold;
    }

    .table-container td {
        color: #ecf0f1;
    }

    .table-container a {
        text-decoration: none;
    }

    
  </style>
  </head>
  <body>
    @include('admin.header')
     @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <div class="page-content">
                    <div class="container mt-5">
                      <!-- Users Table -->
                      <div class="table-container p-4">
                        <table>
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Email</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                              <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
      
            </div>
    </div>
    <!-- JavaScript files-->
   @include('admin.js')
  </body>
</html>