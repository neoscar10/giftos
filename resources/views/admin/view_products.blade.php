<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style type="text/css">
   .div_deg{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 60px
   }

   .table_deg{
    border: 2px solid grey;
   }

   th{
    background-color: rgb(46, 48, 48);
    color: white;
    font-size: 19px;
    font-weight: bold;
    padding: 15px;
   }

   td{
    border: 1px solid grey;
    text-align: center;
    color: white;
   }
   input[type='search']{
    width: 500px;
    height: 60px;
    margin-left: 50px;
   }


    </style>
  </head>
  <body>
   
    @include('admin.header')
   
     @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">


            {{-- Search form --}}
            <form action="{{url('product_search')}}" method="GET">
                <input type="search" name="search" id="">
                <input type="submit" class="btn btn-secondary" value="Search">
            </form>

            <div><h2>All Products</h2></div>

          <div class="div_deg">
    
            <table class="table_deg">
                <tr>
                    <th>Product Title</th>
                    <th>Desctiption</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                @foreach($products as $product)
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{!! Str::limit($product->description, 50) !!}</td>
                        <td>{{$product->category}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                            <img src="products/{{$product->image}}" alt="{{$product->image}}" height="60" width="60">
                        </td>
                        <td>
                            <a href="{{url('update_product', $product->id)}}" class="btn btn-success">Update</a>
                        </td>
                        <td>
                            <a href="{{url('delete_product', $product->id)}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
                        </td>
                        
                    </tr>
                @endforeach
                
            </table>
          </div>

          <div class="div_deg">
            {{$products->onEachSide(1)->Links()}}
          </div>

            
      </div>
    </div>
    
    @include('admin.js')
  </body>
</html>