<!DOCTYPE html>
<html>

<head>
 
    @include('home.css')

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
   
    <!-- end header section -->
    <!-- slider section -->

    @include('home.slider')
    
    <!-- end slider section -->
  </div>
  <!-- end hero area -->
  <!-- Movable cart -->
  

  <!-- shop section -->

    @include('home.products')  
  <!-- end shop section -->
  

   

  <!-- info section -->
  @include('home.footer')
</body>

</html>