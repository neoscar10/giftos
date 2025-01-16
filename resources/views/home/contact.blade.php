<!DOCTYPE html>
<html>

<head>
 
    @include('home.css')

</head>

<body>
  @include('home.header')

  <section class="contact_section ">
      <div class="container px-0">
        <div class="heading_container ">
          <h2 class="">
            Contact Us
          </h2>
        </div>
      </div>
      <div class="container container-bg">
        <div class="row">
          <div class="col-lg-7 col-md-6 px-0">
            <div class="map_container">
              <div class="map-responsive">
                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 px-0">

            <form action="{{ route('contactMail') }}" method="POST">
              @csrf
              <div>
                <input type="text" placeholder="Name" name="name" required />
              </div>
              <div>
                <input type="email" placeholder="Email" name="email" required />
              </div>
              <div>
                <input type="text" placeholder="Phone" name="phone" required />
              </div>
              <div>
                <textarea class="message-box w-100" placeholder="Message" name="message" rows="5" required></textarea>
              </div>
              <div class="d-flex ">
                <button type="submit">SEND</button>
              </div>
            </form>
            
          </div>
        </div>
      </div>
    </section>

    <br><br><br>
    @include('home.footer')
  </body>
  
  </html>