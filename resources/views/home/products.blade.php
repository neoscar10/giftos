

<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Products
        </h2>
      </div>
      <div class="row">
        

        @foreach ($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">
              <a href="{{url('product_details', $product->id)}}">
                <div class="img-box">
                  <img src="products/{{$product->image}}" alt="">
                </div>
                <div class="detail-box">
                  <h6>
                    {{$product->title}}
                  </h6>
                  <h6>
                    Price
                    <span>
                      ${{$product->price}}
                    </span>
                  </h6>
                </div>
              </a> 
              <a href="{{url('add_cart', $product->id)}}" class="btn btn-primary add-to-cart-btn text-white w-100">
                <i class="fas fa-shopping-cart "></i> Add to Cart
            </a>
            </div>
          </div> 
        @endforeach
      </div>
    </div>
  </section>
