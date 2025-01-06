<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
    <body>
        <header class="header">   
          <nav class="navbar navbar-expand-lg">
            <div class="search-panel">
              <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn">Close <i class="fa fa-close"></i></div>
                <form id="searchForm" action="#">
                  <div class="form-group">
                    <input type="search" name="search" placeholder="What are you searching for...">
                    <button type="submit" class="submit">Search</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-between">
              <div class="navbar-header">
                <!-- Navbar Header--><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Dark</strong><strong>Admin</strong></div>
                  <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
              </div>
              <div class="right-menu list-inline no-margin-bottom">    
                <!-- Languages dropdown    -->
                <div class="list-inline-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                  <div aria-labelledby="languages" class="dropdown-menu"><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2"><span>French  </span></a></div>
                </div>
                <!-- Log out               -->
                <div class="list-inline-item logout">                   <a id="logout" href="login.html" class="nav-link">Logout <i class="icon-logout"></i></a></div>
              </div>
            </div>
          </nav>
        </header>
        <div class="d-flex align-items-stretch">
          <!-- Sidebar Navigation-->
          <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
              <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
              <div class="title">
                <h1 class="h5">Logged-in User</h1>
                <p>Email@gmail.com</p>
              </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Panel</span>
            <ul class="list-unstyled">
                    <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>
                    <li><a href="consultations.html"> <i class="icon-user-1"></i>Manage Consultantions </a></li>
                    <li><a href="consultations_requests.html"> <i class="icon-user-1"></i>Bookings </a></li>
                    <li><a href="products.html"> <i class="icon-grid"></i>Products </a></li>
                    <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts/Statistics </a></li>
                    <li><a href="login.html"> <i class="icon-logout"></i>Logout </a></li>
            </ul>
          </nav>
          <!-- Sidebar Navigation end-->
          <div class="page-content">
            <!-- Page Header-->
            <div class="page-header no-margin-bottom">
              <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Consultations Requests</h2>
              </div>
            </div>
            <section>
              <div class="container">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="products">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="start-date">Start Date</label>
                        <input type="date" class="form-control" id="start-date">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="end-date">End Date</label>
                        <input type="date" class="form-control" id="end-date">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="search">Search</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="search" placeholder="Search">
                          <div class="input-group-append">
                            <button class="btn btn-primary" id="filter-btn">Filter</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>
                            <img src="img/avatar-5.jpg" style="width:50px;height:50px;border-radius:10px;border:2px solid #DB6574;">
                        </td>
                        <td>Aliyu Ago</td>
                        <td>080611****</td>
                        <td>Requested</td>
                        <td>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#viewProductModal">View</button>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>
                            <img src="img/avatar-6.jpg" style="width:50px;height:50px;border-radius:10px;border:2px solid #DB6574;">
                        </td>
                        <td>Aliyu Ago</td>
                        <td>080611****</td>
                        <td>Requested</td>
                        <td>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#viewProductModal">View</button>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>
                            <img src="img/avatar-3.jpg" style="width:50px;height:50px;border-radius:10px;border:2px solid #DB6574;">
                        </td>
                        <td>Aliyu Ago</td>
                        <td>080611****</td>
                        <td>Requested</td>
                        <td>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#viewProductModal">View</button>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>
                            <img src="img/avatar-2.jpg" style="width:50px;height:50px;border-radius:10px;border:2px solid #DB6574;">
                        </td>
                        <td>Aliyu Ago</td>
                        <td>080611****</td>
                        <td>Requested</td>
                        <td>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#viewProductModal">View</button>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal">Delete</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
    
            <!-- View Requests Modal -->
            <div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog" aria-labelledby="viewProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="viewProductModalLabel">View Requests</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
    
              <!-- Requestor Picture-->
            <div><img src="img/avatar-6.jpg" style="border-radius:15px;border:2px solid #DB6574;"></div><br>
    
            <h1 class="h5">Logged-in User</h1>
            <p>Gender : <img id="view-product-image" src="" alt=""></p>
            <p>Phone No : <span id="view-product-price"></span></p>
            <p>Email : <span id="view-product-price"></span></p>
            <p>Session: <span id="view-product-id"></span></p>
            <p>Session Date: <span id="view-product-name"></span></p>
            <p>Session Time: <span id="view-product-price"></span></p>
            <p>Session Status: <span id="view-product-price"></span></p>
    
            <button type="button" class="btn btn-success">Accept</button>
            <button type="button" class="btn btn-danger">Reject</button>
            </div>
            </div>
            </div>
            </div>
    
            <!-- Delete Product Modal -->
            <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteProductModalLabel">Delete Time Slot</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Are you sure you want to delete this Consultation Time?</p>
            <button type="button" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </div>
            </div>
            </div>
    
            </div>
            </section>
            <footer class="footer">
              <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                  <p class="no-margin-bottom">2025 &copy; company Name</p>
                </div>
              </div>
            </footer>
          </div>
        </div>
        <!-- JavaScript files-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/popper.js/umd/popper.min.js"> </script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="js/front.js"></script>
      </body>
    </html>
    