<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
      .form-container {
          background-color: #2c3e50;
          border-radius: 10px;
          padding: 30px;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
          color: #ecf0f1;
      }
      .form-header {
          text-align: center;
          margin-bottom: 20px;
      }
      label {
          font-weight: bold;
      }
      input[type="text"],
      input[type="number"],
      select,
      textarea {
          background-color: #34495e;
          border: 1px solid #7f8c8d;
          color: #ecf0f1;
      }
      input[type="text"]:focus,
      input[type="number"]:focus,
      select:focus,
      textarea:focus {
          border-color: #1abc9c;
          outline: none;
          box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
      }
      .btn-success {
          background-color: #1abc9c;
          border-color: #16a085;
      }
      .btn-success:hover {
          background-color: #16a085;
      }
    </style>
  </head>

  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <!-- Page Content -->
    <div class="page-content">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="form-container">
              <h1 class="form-header">Add Product</h1>
              <form action="{{url('upload_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Product Title -->
                <div class="mb-3">
                  <label for="title" class="form-label">Product Title</label>
                  <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <!-- Description -->
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <!-- Price -->
                <div class="mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="text" class="form-control" id="price" name="price" required>
                </div>
                <!-- Quantity -->
                <div class="mb-3">
                  <label for="quantity" class="form-label">Quantity</label>
                  <input type="number" class="form-control" id="quantity" name="qty" required>
                </div>
                <!-- Category -->
                <div class="mb-3">
                  <label for="category" class="form-label">Product Category</label>
                  <select class="form-select" id="category" name="category" required>
                    <option value="" disabled selected>Select category</option>
                    @foreach ($category as $cat)
                      <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                    @endforeach
                  </select>
                </div>
                <!-- Image -->
                <div class="mb-4">
                  <label for="image" class="form-label">Product Image</label>
                  <input type="file" class="form-control" id="image" name="image">
                </div>
                <!-- Submit -->
                <div class="text-center">
                  <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Add Product
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>
