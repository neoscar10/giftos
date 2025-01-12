<!DOCTYPE html>
<html>

<head>
 
    @include('home.css')

    <style>
      input[type='search'] {
      width: 500px;
      height: 40px; 
      padding: 10px;
      margin-right: 10px; 
      border-radius: 5px; 
      border: 1px solid #ccc; 
    }

    .btn {
      padding: 10px 20px;
      border-radius: 5px;
      font-weight: bold;
      text-decoration: none;
      color: white;
      transition: background-color 0.3s;
    }
    </style>

</head>

<body>
  <div class="hero_area">

    @include('home.header')
  </div>

  <!-- Search form -->
  <form class="mt-5" action="{{url('search')}}" method="GET" style="display: flex; justify-content: center; margin-bottom: 20px;">
    <input type="search" name="search" placeholder="Search for products..." required>
    <input type="submit" class="btn btn-secondary" value="Search">
  </form>

    @include('home.products')  

    @include('home.footer')

 
</body>

</html>