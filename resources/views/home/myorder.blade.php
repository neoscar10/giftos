<!DOCTYPE html>
<html>

<head>
 
    @include('home.css')

    <style>
        .div_deg{
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 60px;
        }
        .cart-value{
            text-align: center;
            margin-bottom: 70px;
            padding: 20px
        }

        table{
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }
        th{
            border: 2px sold black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: bold;
            background-color: black; 
            height: 60px;
        }
        td{
            border: 1px solid gray;
            padding: 10px;
        }
        /* order details table */

        .order_deg{
            padding-right: 50px;
            margin-top: -50px;
        }
        label{
            display: inline-block;
            width: 150px;
        }
        .div_gap{
            padding: 20px
        }


    </style>

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
  </div>

  <div class="div_deg">
    <table>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Delivery Status</th>
        </tr>

        @foreach ($orders as $order)
            <tr>
                <td>{{$order->product->title}}</td>
                <td>{{$order->product->price}}</td>
                <td>
                    <img height="50" width="50" src="/products/{{$order->product->image}}" alt="">
                </td>
                <td>{{$order->status}}</td>
            </tr>  
        @endforeach
       

        
       
    </table>
  </div>
  

 

  @include('home.footer')
</body>

</html>