<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
      .form-container {
          background-color: #2c3e50;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
          color: #ecf0f1;
          text-align: center;
      }

      .form-container input[type="text"] {
          background-color: #34495e;
          border: 1px solid #7f8c8d;
          color: #ecf0f1;
          width: 300px;
          height: 50px;
          margin-right: 10px;
          padding: 10px;
      }

      .form-container input[type="text"]:focus {
          border-color: #1abc9c;
          outline: none;
          box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
      }

      .table-container {
          margin-top: 50px;
      }

      .table-container table {
          border-collapse: collapse;
          width: 80%;
          margin: auto;
          text-align: center;
          background-color: #34495e;
      }

      .table-container th,
      .table-container td {
          padding: 15px;
          border: 1px solid #7f8c8d;
      }

      .table-container th {
          background-color: #1abc9c;
          color: white;
          font-weight: bold;
      }

      .table-container td {
          color: #ecf0f1;
      }

      .table-container a {
          text-decoration: none;
      }

      .btn-primary {
          background-color: #1abc9c;
          border-color: #16a085;
      }

      .btn-primary:hover {
          background-color: #16a085;
      }

      .btn-danger:hover {
          background-color: #e74c3c;
      }
    </style>
  </head>

  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="container mt-5">
        <!-- Add Category Form -->
        <div class="form-container">
          <h1 class="mb-4">Add Category</h1>
          <form action="{{url('add_category')}}" method="POST">
            @csrf
            <input type="text" name="category" placeholder="Enter category name" required>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-plus-circle"></i> Add Category
            </button>
          </form>
        </div>

        <!-- Category Table -->
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $category)
                <tr>
                  <td>{{$category->category_name}}</td>
                  <td>
                    <a class="btn btn-success" href="{{url('edit_category', $category->id)}}">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                  </td>
                  <td>
                    <a class="btn btn-danger" href="{{url('delete_category', $category->id)}}" onclick="confirmation(event)">
                      <i class="fas fa-trash"></i> Delete
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    @include('admin.js')

    <script>
      function confirmation(event) {
          if (!confirm("Are you sure you want to delete this category?")) {
              event.preventDefault();
          }
      }
    </script>
  </body>
</html>
