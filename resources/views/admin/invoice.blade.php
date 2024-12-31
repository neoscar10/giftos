<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJr+ufkK7S5FHV8k0e9XKh4K9lLIXI1bHxh3Ljl3ImAXfayY9D/7YcP1X8Sb" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .invoice-container {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
        }
        .invoice-header {
            text-align: center;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 20px;
        }
        .invoice-header h2 {
            color: #2c3e50;
            font-size: 28px;
        }
        .invoice-header p {
            font-size: 16px;
            color: #7f8c8d;
        }
        .invoice-details {
            margin-top: 20px;
            padding: 15px;
        }
        .invoice-details h3 {
            font-size: 20px;
            color: #34495e;
        }
        .invoice-table {
            margin-top: 30px;
        }
        .invoice-table th {
            background-color: #34495e;
            color: white;
            padding: 12px;
        }
        .invoice-table td {
            padding: 12px;
            text-align: center;
            background-color: #ecf0f1;
        }
        .invoice-image {
            margin-top: 20px;
            text-align: center;
        }
        .invoice-footer {
            margin-top: 30px;
            border-top: 2px solid #e0e0e0;
            padding-top: 10px;
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>

    <div class="container invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <h2>Invoice</h2>
            <p><strong>Date:</strong> {{ date('Y-m-d') }}</p>
        </div>

        <!-- Customer Details -->
        <div class="invoice-details">
            <h3>Customer Details</h3>
            <p><strong>Name:</strong> {{$data->name}}</p>
            <p><strong>Address:</strong> {{$data->rec_address}}</p>
            <p><strong>Phone:</strong> {{$data->phone}}</p>
        </div>

        <!-- Product Details -->
        <div class="invoice-details">
            <h3>Product Details</h3>
            <table class="table table-bordered invoice-table">
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$data->product->title}}</td>
                        <td>${{$data->product->price}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Product Image -->
        <div class="invoice-image">
            <img height="250" width="300" src="products/{{$data->product->image}}" alt="Product Image">
        </div>

        <!-- Invoice Footer -->
        <div class="invoice-footer">
            <p>Thank you for your purchase!</p>
        </div>
    </div>

    <!-- Bootstrap JS (optional for modal, dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybWl5A+w3h5mFU8t3wAs73m6gZ68pH6gk97B2hR4UoP7Y8xNKt" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0p8pINr8wAK1hU9G1Z/J29GR9J8mJ0/6aX1WeBLm8E2gtxWz" crossorigin="anonymous"></script>
</body>
</html>
