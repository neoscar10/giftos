<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')

    <style type="text/css">
        input[type='text']{
            height:50px;
            width: 400px;
        }

        .div_deg{
          display: flex;
          justify-content: center;
          align-content: center; 
          margin: 30px; 
        }

        .table_deg{
            text-align: center;
            margin: auto;
            border: 2px solid grey;
            margin-top: 50px;
            width: 600px;
        }

        th{
            background-color: rgb(65, 62, 62);
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        td{
            color: white;
            padding: 10px;
            border: 1px solid gray;
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

            <h1 style="color: white">Add Category</h1>
           <div class="div_deg">
           
                <form action="{{url('add_category')}}" method="POST">
                    @csrf
                    <div>
                        <input type="text" name="category">
                        <input class="btn btn-primary" type="submit" value="Add Category">
                    </div>
               </form>
           </div>

           <div>
            <table class="table_deg">
                <tr>
                    <th>Category name</th>
                    <th>Edit</th>
                    <th>Delete</th> 
                </tr>
                @foreach ($data as $data)
                    <tr>
                        <td>{{$data->category_name}}</td>

                        <td>
                            <a class="btn btn-success" href="{{url('edit_category', $data->id)}}" onclick="">Edit</a>
                        </td>

                        <td>
                            <a class="btn btn-danger" href="{{url('delete_category', $data->id)}}" onclick="confirmation(event)">Delete</a>
                        </td>
                    </tr>
                @endforeach
                
            </table>

           </div>

            
      </div
    </div> 
    @include('admin.js')
  </body>
</html>