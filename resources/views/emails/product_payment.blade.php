<!DOCTYPE html>
<html>
<head>
    <title>Product Payment Confirmation</title>
</head>
<body>
    <h1>Thank you for your purchase, {{ Auth::user()->name }}!</h1>
    <p>We have received your payment. Here are the details of your order:</p>

    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartData as $item)
                <tr>
                    <td>{{ $item->product->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total:</strong> ${{ number_format($cartData->sum(function ($item) { return $item->product->price * $item->quantity; }), 2) }}</p>

    <p>Your order is being processed and will be shipped to: <strong>{{ Auth::user()->address }}</strong>.</p>
    <p>If you have any questions, feel free to contact us.</p>

    <p>Thank you for shopping with us!</p>
</body>
</html>
