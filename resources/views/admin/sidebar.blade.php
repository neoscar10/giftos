<div class="d-flex align-items-stretch">
 <!-- Sidebar Navigation-->
 <nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      {{-- <div class="avatar"><img src="{{asset('admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div> --}}
      <div class="title">
        <h1 class="h5">{{Auth::user()->name}}</h1>
        <p>Admin</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
      <!-- Products Dropdown -->
      <!-- Other Links -->
      <li><a href="{{url('admin/dashboard')}}"> <i class="icon-home"></i> Home </a></li>
      <li><a href="{{url('view_category')}}"> <i class="icon-grid"></i> Category </a></li>
      <li><a href="{{url('view_orders')}}"> <i class="icon-grid"></i> Orders </a></li>
      <li>
        <a href="#productsDropdown" aria-expanded="false" data-toggle="collapse">
            <i class="icon-windows"></i> Products
        </a>
        <ul id="productsDropdown" class="collapse list-unstyled">
            <li><a href="{{url('add_product')}}">Add Products</a></li>
            <li><a href="{{url('view_product')}}">View Products</a></li>
        </ul>
    </li> 
    <li>
      <a href="#consultationDropdown" aria-expanded="false" data-toggle="collapse">
          <i class="icon-windows"></i> Consultation
      </a>
      <ul id="consultationDropdown" class="collapse list-unstyled">
          <li><a href="{{url('manage_time_slots')}}">Manage Time Slots</a></li>
          <li><a href="{{url('view_appointments')}}">View Appointments</a></li>
      </ul>
  </li>
  </ul>
  
  </nav>