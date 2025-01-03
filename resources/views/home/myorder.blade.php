<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <!-- Font Awesome for Icons -->
    

    <style>
        .hero_area {
            padding: 20px 0;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- Header section -->
        @include('home.header')
    </div>

    <div class="container my-5">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Delivery Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->product->title}}</td>
                            <td>${{$order->product->price}}</td>
                            <td>
                                <img src="/products/{{$order->product->image}}" alt="product image" class="img-fluid" style="max-width: 50px; height: auto;">
                            </td>
                            <td>
                                @if ($order->status == 'Delivered')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i> Delivered
                                    </span>
                                @elseif ($order->status == 'Pending')
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-hourglass-half"></i> Pending
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle"></i> {{$order->status}}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    @include('home.footer')
</body>

</html>
