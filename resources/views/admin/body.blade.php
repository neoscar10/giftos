<style>
  .statistic-card {
  display: block; /* Ensures the link takes the full card's space */
  text-decoration: none; /* Removes the underline */
  }

  .statistic-card:hover {
    text-decoration: none; /* Prevent underline on hover */
  }

  .statistic-block {
    transition: transform 0.2s ease; /* Optional: Add hover animation */
  }

  .statistic-card:hover .statistic-block {
    transform: scale(1.05); /* Optional: Slightly enlarge card on hover */
  }

</style>


<h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-3 col-sm-6">
                  <a href="{{url('view_admins')}}" class="statistic-card">
                  <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                      
                      <div class="title">
                        <div class="icon"><i class="icon-user-1"></i></div><strong>Total Admins</strong>
                      </div>
                    
                      <div class="number dashtext-1">{{$admins}}</div>
                    </div>
                    <div class="progress progress-template">
                      <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                    </div>
                  </div>
                  </a>
                </div>
             
              
              <div class="col-md-3 col-sm-6">
                <a href="{{url('view_users')}}" class="statistic-card">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-user-1"></i></div><strong>Total Users</strong>
                    </div>
                    <div class="number dashtext-1">{{$users}}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                  </div>
                </div>
                </a>
              </div>
            

              <div class="col-md-3 col-sm-6">
                <a href="{{url('view_product')}}" class="statistic-card">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-contract"></i></div><strong>All Products</strong>
                    </div>
                    <div class="number dashtext-2">{{$products}}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
                </a>
              </div>

              <div class="col-md-3 col-sm-6">
                <a href="{{url('view_orders')}}" class="statistic-card">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Total Orders</strong>
                    </div>
                    <div class="number dashtext-1">{{$orders}}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                  </div>
                </div>
                </a>
              </div>

              <div class="col-md-3 col-sm-6">
                <a href="{{url('delivered_orders')}}" class="statistic-card">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon">
                        {{-- <span class="material-symbols-outlined" style="font-size: 2rem">
                          local_shipping
                          </span> --}}
                        </div><strong>Delivered</strong>
                    </div>
                    <div class="number text-success">{{$delivered}}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                  </div>
                </div>
                </a>
              </div>

              <div class="col-md-3 col-sm-6">
                <a href="{{url('not_delivered')}}" class="statistic-card">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon">
                        {{-- <span class="material-symbols-outlined" style="font-size: 2rem">
                          local_shipping
                          </span> --}}
                        </div><strong>Not Delivered</strong>
                    </div>
                    <div class="number dashtext-3">{{$not_delivered}}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="90" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                  </div>
                </div>
                </a>
              </div>
  
            </div>
          </div>
        </section>
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
               <p class="no-margin-bottom">2025 &copy; Gani Rights Reserved - Powered by Rhino Innovation Lab Limmited, Nigeria</p>
            </div>
          </div>
        </footer>