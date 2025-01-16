<style>
  @media (max-width: 768px) {
    .detail-box {
      padding: 0 10px; /* Reduce padding even further on small screens */
    }

    .heading {
      font-size: 1.8rem; /* Smaller heading for small screens */
    }

    .description {
      font-size: 1rem; /* Slightly smaller text */
    }

    .img-box img {
      max-width: 250px; /* Smaller image for smaller screens */
    }
    h1{
      font-size: 20rem;
    }
  }

  @media (min-width: 1200px) {
    .img-box img {
      max-width: 500px; /* Larger image for larger screens */
    }
  }
</style>


<section class="slider_section">
    <div class="slider_container">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box"> 
                    <h1 class="heading">
                      Welcome To Gani<br>
                      Clothing Line
                    </h1>
                    <p>
                      Sequi perspiciatis nulla reiciendis, rem, tenetur impedit, eveniet non necessitatibus error distinctio mollitia suscipit. Nostrum fugit doloribus consequatur distinctio esse, possimus maiores aliquid repellat beatae cum, perspiciatis enim, accusantium perferendis.
                    </p>
                    <a href="{{url('contact')}}">
                      Contact Us
                    </a>
                  </div>
                </div>
                <div class="col-md-5 ">
                  <div class="img-box">
                    <img style="width:600px" src="images/image3.jpeg" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </section>
