<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style type="text/css">
    .div_deg{
        display: flex;
        justify-content: center;
        align-content: center;
    }

    label{
        display: inline-block;
        widows: 200px;
        padding: 20px; 
    }

    textarea{
        width: 400px;
        height: 100px;
    }
    input[type='text']{
        width: 300px;
        height: 60px;
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

          <h2>Update Product</h2>

          <div class="div_deg">
            <form action="{{url('edit_product',  $data->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{$data->title}}">
                </div>

                <div>
                    <label for="">Description</label>
                    <textarea name="description" id="">{{$data->description}}</textarea>
                </div>

                <div>
                    <label for="">Price</label>
                    <input type="text" name="price" value="{{$data->price}}">
                </div>

                <div>
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" value="{{$data->quantity}}">
                </div>

                <div>
                    <label for="">Category</label>
                    <select name="category" id="">
                        <option value="{{$data->category}}">{{$data->category}}</option>

                        @foreach ($category as $cat)
                        <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                            
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="">Current Image</label>
                    <img width="150" src="/products/{{$data->image}}" alt="">
                </div>
                <div>
                    <label for="">New omage</label>
                    <input type="file" name="image" id="">
                </div>

                <div>
                   
                    <input type="submit" class="btn btn-success" value="Update Product">
                </div>


            </form>
          </div>
            
      </div>
    </div>
    <!-- JavaScript files-->
   @include('admin.js')
  </body>
</html>