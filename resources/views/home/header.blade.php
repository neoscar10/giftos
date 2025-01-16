<header class="header_section">
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


  <nav class="navbar navbar-expand-lg custom_nav-container" style="z-index: 1">
    <span>
      <img src="images/logo.jpeg" alt="Logo" style="width: 40px; height: 40px; vertical-align: middle; margin-right: 10px; border-radius: 50%;">
      <span class="" style="font-family: 'Brush Script MT', cursive; font-weight: bold; font-size: 24px;">Ggani Clothing Line</span>
    </span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class=""></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('shop')}}">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('book_consultation')}}">Tennis Consulatation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('why')}}">Why Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('contact')}}">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="testimonial.html"></a>
        </li>
      </ul>

      <div class="user_option">
        @if (Route::has('login'))
          @auth
            <a href="{{url('myorders')}}">My Orders</a>

            <!-- Cart icon with total number of items -->
            <a href="{{url('mycart')}}">
              <i class="fa fa-shopping-cart" aria-hidden="true">
                <span class="cart-count p-1">{{$count}}</span>
              </i>
            </a>
            

           <a href="{{url('notification')}}"> <i class="fa-solid fa-bell"></i></a>

            @include('home.moveable_cart')
            

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <input class="btn btn-primary p-2 mx-4" type="submit" value="Logout">
            </form>

          @else
          <a href="{{url('mycart')}}">
            <i class="fa fa-shopping-cart" aria-hidden="true">
              <span class="cart-count p-1">{{$count}}</span>
            </i>
          </a>
          @include('home.moveable_cart')

            <a href="{{url('/login')}}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>Login</span>
            </a>
            
            <a href="{{url('/register')}}">
              <i class="fa fa-vcard" aria-hidden="true"></i>
              <span>Signup</span>
            </a>

            
          @endauth
        @endif

        <form class="form-inline">
         
        </form>
      </div>
    </div>
  </nav>
</header>
