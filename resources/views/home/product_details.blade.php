<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .hero_area {
            padding: 20px 0;
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .product-price {
            font-size: 1.25rem;
            color: #28a745;
        }

        .product-category,
        .product-quantity {
            font-size: 1rem;
            color: #555;
        }

        .product-description {
            font-size: 1rem;
            color: #666;
            margin-top: 15px;
        }

        .add-to-cart-btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <!-- Product details start -->
    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Just cart it</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center">
                        <img src="/products/{{$product->image}}" alt="Product Image" class="product-image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <h6 class="product-title">{{$product->title}}</h6>
                        <h6 class="product-price">
                            Price: <span>${{$product->price}}</span>
                        </h6>
                        <h6 class="product-category">
                            Category: <span>{{$product->category}}</span>
                        </h6>
                        <h6 class="product-quantity">
                            Available Quantity: <span>{{$product->quantity}}</span>
                        </h6>
                        <p class="product-description">{{$product->description}}</p>
                        <a href="{{url('add_cart', $product->id)}}" class="btn btn-primary add-to-cart-btn">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product details end -->

    @include('home.footer')
</body>

</html>
