<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style type="text/css">
      .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;
        flex-direction: column; /* Added column direction for better layout */
      }

      .table_deg {
        border: 2px solid grey;
        width: 90%; /* Make the table width responsive */
        margin-top: 20px;
        border-collapse: collapse; /* Improve table border style */
      }

      th {
        background-color: rgb(46, 48, 48);
        color: white;
        font-size: 19px;
        font-weight: bold;
        padding: 15px;
      }

      td {
        border: 1px solid grey;
        text-align: center;
        color: white;
      }

      input[type='search'] {
        width: 500px;
        height: 40px; /* Reduced height for a cleaner look */
        padding: 10px;
        margin-right: 10px; /* Space between the search box and button */
        border-radius: 5px; /* Rounded corners */
        border: 1px solid #ccc; /* Light border color */
      }

      .btn {
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
        color: white;
        background-color: #2ecc71; /* Change this color as per your preference */
        transition: background-color 0.3s;
      }

      .btn:hover {
        background-color: #27ae60; /* Darker hover effect */
      }

      .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }

      .pagination a {
        color: #2c3e50;
        padding: 8px 16px;
        margin: 0 5px;
        text-decoration: none;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      .pagination a:hover {
        background-color: #ecf0f1;
      }

      /* Optional: Style for the delete confirmation */
      .btn-danger {
        background-color: #e74c3c;
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
          <!-- Search form -->
          <form action="{{url('product_search')}}" method="GET" style="display: flex; justify-content: center; margin-bottom: 20px;">
            <input type="search" name="search" placeholder="Search for products..." required>
            <input type="submit" class="btn btn-secondary" value="Search">
          </form>

          <div><h2>All Products</h2></div>

          <div class="div_deg">
            <table class="table_deg">
              <thead>
                <tr>
                  <th>Product Title</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Image</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                  <tr>
                    <td>{{$product->title}}</td>
                    <td>{!! Str::limit($product->description, 50) !!}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td><img src="products/{{$product->image}}" alt="{{$product->image}}" height="60" width="60"></td>
                    <td><a href="{{url('update_product', $product->id)}}" class="btn btn-success">Update</a></td>
                    <td>
                      <a href="{{url('delete_product', $product->id)}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="div_deg">
            {{$products->onEachSide(1)->links()}}
          </div>

        </div>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>
