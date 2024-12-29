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
    <div class="order_deg">
        <form action="{{url('confirm_order')}}" method="POST">
            @csrf

            <div class="div_gap">
                <label for="">Receiver's Name</label>
                <input type="text" name="name" value="{{Auth::user()->name}}">
            </div>

            <div class="div_gap">
                <label for="">Receiver's Phone</label>
                <input type="text" name="phone" value="{{Auth::user()->phone}}">
            </div>

            <div class="div_gap">
                <label for="">Receiver's Address</label>
                <textarea rows="3" name="address" value="">{{Auth::user()->address}}</textarea>
                
            </div>

            <div class="div_gap">
                <input type="submit" class="btn btn-primary"  value="Place Order">
            </div>
        </form>
    </div>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Delete</th>
        </tr>

        <?php
            $total = 0;
        ?>

        @foreach ($cartData as $data)
            <tr>
                <td>{{$data->product->title}}</td>
                <td>{{$data->product->price}}</td>
                <td>
                    <img width="100" height="70" src="/products/{{$data->product->image}}" alt="product image">
                </td>
                <td><a class="btn btn-danger" href="{{url('deleteCartIten',$data->id)}}">Remove</a></td>
            </tr>
            <?php
                $total = $total + $data->product->price;
            ?>
        @endforeach  
    </table>
  </div>
  <div class="cart-value">
    <h4>Total price: N{{$total}}</h4> 
  </div>

 

  @include('home.footer')
</body>

</html>