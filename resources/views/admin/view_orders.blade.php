<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
      pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }

      .pagination a {
        color: #2c3e50;
        padding: 8px 16px;
        margin: 0 5px;
        text-decoration: none;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      .pagination a:hover {
        background-color: #ecf0f1;
      }
      
      table {
        border: 2px solid grey;
        text-align: center;
        width: 100%;
        border-collapse: collapse;
      }
      
      th {
        padding: 2px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
      }
      
      td {
        border: 1px solid grey;
        padding: 2px;
      }
      
      .table_center {
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
      }

      .btn {
        padding: 4px 8px;
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
        padding: 0 10px;
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
                  <th>Quantity</th>
                  <th>Date</th>
                  <th>Image</th>
                  <th>Payment Status</th>
                  <th>Status</th>
                  <th>Change Status</th>
                  <th>Download PDF</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                  <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->rec_address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product->title}}</td>
                    <td>${{$order->product->price}}</td>
                    <td>{{$order->qnty}}</td>
                    <td>{{$order->created_at->format('d M, Y')}}</td>
                    <td>
                      <img height="30" width="50" src="/products/{{$order->product->image}}" alt="">
                    </td>
                    <td>{{$order->payment_status}}</td>
                    <td>
                      {{-- getting different colors for order status --}}
                      @if ($order->status == 'On the way')
                        <span style="color: yellow">{{$order->status}}</span>
                      @elseif ($order->status == 'Delivered')
                        <span style="color: green">{{$order->status}}</span>
                      @else
                        <span style="color: red">{{$order->status}}</span>
                      @endif
                    </td>
                    <td class="action-buttons">
                      <a href="{{url('on_the_way',$order->id)}}" class="btn btn-secondary">On the way</a>
                      <a href="{{url('delivered',$order->id)}}" class="btn btn-success">Delivered</a>
                    </td>
                    <td>
                      <a class="btn" style="background-color: rgb(111, 185, 209)" href="{{url('download_ppdf', $order->id)}}">Download PDF</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="div_deg">
            {{$orders->onEachSide(1)->links()}}
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>
