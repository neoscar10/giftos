<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
      body {
        background-color: #f4f6f9;
        font-family: Arial, sans-serif;
      }

      .page-header {
        margin-bottom: 30px;
      }

      .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }

      .form-container {
        background-color: #2c3e50; /* Dark background */
        color: white; /* White text color */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 70%;
        margin-top: 50px; /* Push the form down by 50px */
      }

      .form-container h2 {
        margin-bottom: 20px;
        font-size: 24px;
        text-align: center;
        color: #ecf0f1; /* Light text color for the header */
      }

      label {
        display: inline-block;
        width: 150px;
        padding: 10px;
        font-size: 16px;
        color: #bdc3c7; /* Lighter color for labels */
      }

      input[type='text'], input[type='number'], select, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #34495e; /* Darker border */
        border-radius: 5px;
        background-color: #34495e; /* Dark background for inputs */
        color: white; /* White text for inputs */
      }

      input[type='file'] {
        width: auto;
        padding: 10px;
        border: 1px solid #34495e; /* Darker border for file input */
        border-radius: 5px;
        background-color: #34495e;
      }

      textarea {
        height: 100px;
      }

      .submit-btn {
        background-color: #27ae60;
        color: white;
        padding: 12px 20px;
        border: none;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
      }

      .submit-btn:hover {
        background-color: #2ecc71;
      }

      .current-image {
        width: 150px;
        margin: 10px 0;
      }

      .page-content {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="form-container">
        <h2>Update Product</h2>
        <form class="mt-4" action="{{url('edit_product',  $data->id)}}" method="POST" enctype="multipart/form-data">
          @csrf

          <div>
            <label for="">Title</label>
            <input type="text" name="title" value="{{$data->title}}">
          </div>

          <div>
            <label for="">Description</label>
            <textarea name="description">{{$data->description}}</textarea>
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
            <select name="category">
              <option value="{{$data->category}}">{{$data->category}}</option>
              @foreach ($category as $cat)
                <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label for="">Current Image</label>
            <div><img class="current-image" src="/products/{{$data->image}}" alt="Product Image"></div>
          </div>

          <div>
            <label for="">New Image</label>
            <input type="file" name="image">
          </div>

          <div>
            <input type="submit" class="submit-btn" value="Update Product">
          </div>
        </form>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>
