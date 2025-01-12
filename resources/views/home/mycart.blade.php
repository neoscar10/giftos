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
        <div><h5 class="text-uppercase font-weight-normal">shopping cart</h5></div>
        
        <div class="font-weight-normal">{{$count}}  {{$count>1? "Items" : "Item" }}</div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    @foreach ($cartData as $data)
                        <tr>
                            <td>{{$data->product->title}}</td>
                            <td>${{$data->product->price}}</td>
                            <td>
                                <div class="input-group justify-content-center" style="max-width: 120px;">
                                    <button class="btn btn-outline-secondary btn-sm" 
                                            onclick="updateQuantity(event, {{$data->id}}, 'decrease')">−</button>
                                    <input type="number" class="form-control text-center"
                                            name="quantity" 
                                           value="{{$data->quantity}}" 
                                           id="quantity-{{$data->id}}" 
                                           readonly>
                                    <button class="btn btn-outline-secondary btn-sm" 
                                            onclick="updateQuantity(event, {{$data->id}}, 'increase')">+</button>
                                </div>   
                            </td>
                            
                            <td>
                                <img src="/products/{{$data->product->image}}" alt="product image" class="img-fluid" style="max-width: 100px; height: auto;">
                            </td>
                            <td>
                                <a class="" href="{{url('deleteCartIten', $data->id)}}">
                                    <i class="fas fa-times" style="color: red;"></i>
                                        <span>Remove</span>
                                </a>
                            </td>
                        </tr>
                        <?php $total += $data->product->price * $data->quantity; ?>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center my-4">
            <h4>Total price: <span class="text-success total-price">${{$total}}</span></h4>
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
                    <a class="btn btn-success" href="{{ url('stripe', ['total' => $total, 'type' => 'product']) }}">Pay with Card</a>
                    <a class="btn btn-success" href="{{ url('pay', ['total' => $total, 'type' => 'product']) }}">Pay with PayPal</a>
                    
                </div>
            </form>
        </div>
    </div>

    @include('home.footer')





    <script>
        function updateQuantity(event, cartId, action) {
    event.preventDefault();

    const quantityInput = document.getElementById(`quantity-${cartId}`);
    let currentQuantity = parseInt(quantityInput.value);

    if (action === 'increase') {
        currentQuantity++;
    } else if (action === 'decrease') {
        if (currentQuantity > 1) {
            currentQuantity--;
        } else {
            alert("Quantity cannot be less than 1.");
            return;
        }
    }

    // Update the UI
    quantityInput.value = currentQuantity;

    // Send an AJAX request to update the server-side cart
    fetch(`/updateCartQuantity/${cartId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ quantity: currentQuantity }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the total price dynamically
            document.querySelector('.total-price').innerText = `$${data.newTotal}`;
        } else {
            console.error("Failed to update quantity.");
        }
    })
    .catch(error => console.error("Error:", error));
}

    </script>
    
</body>

</html>
