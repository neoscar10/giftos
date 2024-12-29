<!DOCTYPE html>
<html>

<head>
 
    @include('home.css')

    <style>
        .div_center{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        .detail-box{
            padding: 15px
        }
    </style>

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')  
  </div>

  {{-- Product details start --}}
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">

        
          <div class="col-md-12">
            <div class="box">
              
                <div class="div_center">
                  <img width="400" src="/products/{{$product->image}}" alt="">
                </div>
                <div class="detail-box">
                  <h6>
                    {{$product->title}}
                  </h6>
                  <h6>
                    Price
                    <span>
                      N{{$product->price}}
                    </span>
                  </h6>
                </div>
                
                <div class="detail-box">
                    <h6>
                      Category: {{$product->category}}
                    </h6>
                    <h6>
                      Available Quantity
                      <span>
                        {{$product->quantity}}
                      </span>
                    </h6>
                </div>

                <div class="detail-box">
                    
                    
                     
                    <p>{{$product->description}}</p>
                      
                  </div>
             
            </div>
          </div> 
       
      </div>
    </div>
  </section>


  {{-- Product details end --}}
  
  

 
   

  <!-- info section -->
  @include('home.footer')
</body>

</html>