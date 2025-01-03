<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
      table {
        border: 2px solid grey;
        text-align: center;
        width: 100%;
        border-collapse: collapse;
      }
      
      th {
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
      }
      
      td {
        border: 1px solid grey;
        padding: 10px;
      }
      
      .table_center {
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
      }

      .btn {
        padding: 8px 16px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        margin: 5px;
        display: inline-block;
      }

      .btn-secondary {
        background-color: #f39c12;
      }

      .btn-success {
        background-color: #27ae60;
      }

      .page-header h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 20px;
      }

      .container-fluid {
        padding: 0 30px;
      }
     

      /* Ensures the buttons stay side by side */
      .action-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
      }

      /* Making the layout responsive */
      @media (max-width: 768px) {
        .action-buttons {
          flex-direction: column;
          align-items: center;
        }
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
          <h2 style="color: white">All Orders</h2>
          <div class="table_center">
            <table>
              <thead>
                <tr>
                  <th>Customer name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Product title</th>
                  <th>Price</th>
                  <th>Image</th>
                 
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                  <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->rec_address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product->title}}</td>
                    <td>N{{$order->product->price}}</td>
                    <td>
                      <img height="30" width="50" src="/products/{{$order->product->image}}" alt="">
                    </td>
                    
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>
