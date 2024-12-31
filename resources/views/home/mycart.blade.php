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
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    @foreach ($cartData as $data)
                        <tr>
                            <td>{{$data->product->title}}</td>
                            <td>{{$data->product->price}}</td>
                            <td>
                                <img src="/products/{{$data->product->image}}" alt="product image" class="img-fluid" style="max-width: 100px; height: auto;">
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="{{url('deleteCartIten', $data->id)}}">
                                    <i class="fas fa-trash"></i> Remove
                                </a>
                            </td>
                        </tr>
                        <?php $total += $data->product->price; ?>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center my-4">
            <h4>Total price: <span class="text-success">N{{$total}}</span></h4>
        </div>

        <div class="card mx-auto shadow-sm p-4" style="max-width: 600px;">
            <h5 class="card-title text-center mb-4">Order Details</h5>
            <form action="{{url('confirm_order')}}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Receiver's Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{Auth::user()->name}}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Receiver's Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{Auth::user()->phone}}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Receiver's Address</label>
                    <textarea name="address" id="address" rows="3" class="form-control" required>{{Auth::user()->address}}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Cash on Delivery</button>
                    <a class="btn btn-success" href="{{url('stripe', $total)}}">Make Payment</a>
                </div>
            </form>
        </div>
    </div>

    @include('home.footer')
</body>

</html>
