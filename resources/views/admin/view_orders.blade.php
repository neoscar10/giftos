<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')

   <style>
      table{
        border: 2px solid grey;
        text-align: center;
      }
      th{
        
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
      }
      td{
        border: 1px solid grey;
        padding: 10px
      }
      .table_center{
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
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
            <div class="table_center">
                <table>
                  <tr>
                    <th>Customer name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>Download PDF</th>
                  </tr>
                  @foreach ($orders as $order)
                    <tr>
                      <td>{{$order->name}}</td>
                      <td>{{$order->rec_address}}</td>
                      <td>{{$order->phone}}</td>
                      <td>{{$order->product->title}}</td>
                      <td>{{$order->product->price}}</td>
                      <td>
                        <img height="30" width="50" src="/products/{{$order->product->image}}" alt="">
                      </td>
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
                      <td>
                        <a href="{{url('on_the_way',$order->id)}}" class="btn btn-secondary">On the way</a>
                        <a href="{{url('delivered',$order->id)}}" class="btn btn-success">Delivered</a>
                      </td>
                      <td>
                        <a class="btn btn-secondary" href="{{url('download_ppdf', $order->id)}}">Download PDF</a>
                      </td>

                    </tr>
                  @endforeach
                  
                </table>
            </div>
               
            </div>
    </div>
    <!-- JavaScript files-->
   @include('admin.js')
  </body>
</html>