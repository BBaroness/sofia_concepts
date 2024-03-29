<?php
  // Start the session
  session_start();

  unset($_SESSION['login_return_url']);					// Remove any previously set return url
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Allure Hair and Beauty Salon</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <div class="hero-wrap js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
          	<div class="icon">
          		<a href="index.php" class="logo">
          			<span class="flaticon-flower"></span>
          			<h1>Allure</h1>
          		</a>
          	</div>
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Hair and Beauty Salon</h1>
            <p class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Created by <a href="#">Sofia Concepts</a></p>

            <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="https://vimeo.com/45830194" class="btn btn-white btn-outline-white px-4 py-3">View Our Services</a></p>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">ALLURE</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About Us</a></li>
	          <li class="nav-item"><a href="services.html" class="nav-link">Our Services</a></li>
	          <li class="nav-item"><a href="booking.php" class="nav-link">Appointment Booking</a></li>
	          <li class="nav-item"><a href="shop.html" class="nav-link">Shop</a></li>
			  <li class="nav-item"><a href="testimonials.php" class="nav-link">Testimonials</a></li>
			  
			  <!-- Add Dynamic parts for user interaction -->
			  
				<?php if (!isset($_SESSION['logged_in_client'])): ?>
					<li class="nav-item"><a href="login.php" class="nav-link"><strong>Log in</strong></a></li>
				<?php else: ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<b><?php echo $_SESSION['logged_in_client']['fname']; ?></b>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">My Appointments</a>
							<a class="dropdown-item" href="client/profile.php">Edit Profile</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					</li>
				<?php endif; ?>
			  
	        </ul>
	      </div>
		</div>

	  </nav>
    <!-- END nav -->
    <section class="ftco-section">
    <h2><center>WHAT WE DO...</center></h2>
    	<div class="container">
    		<div class="row">
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex mb-3"><span class="flaticon-facial-treatment"></span></div>
              <div class="media-body">
                <h3 class="heading">Facial Treatment</h3>
                <p>....</p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex mb-3"><span class="flaticon-cosmetics"></span></div>
              <div class="media-body">
                <h3 class="heading">Nail Care</h3>
                <p>We provide you with the traditional Manicures and Pedicures, Spa Manicures and Pedicures, and Nail Enhancement Services.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex mb-3"><span class="flaticon-curl"></span></div>
              <div class="media-body">
                <h3 class="heading">Hair Styling</h3>
                <p>Our very competent team is capable of doing hairstyles suitable for all events. </p>
              </div>
            </div>    
          </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Our Beauty Experts</h2>
            <p>.</p>
          </div>
        </div>
        <div class="row">
        	<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url(images/staff/staff2.jpg);"></div>
      				<div class="info text-center">
      					<h3><a href="#">Abena Foriwaa</a></h3>
      					<span class="position">Stylist</span>
      					<div class="text">
	        				<p>Well trained stylist.</p>
	        			</div>
      				</div>
        		</div>
        	</div>
        	<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url(images/staff/staff4.jpg);"></div>
      				<div class="info text-center">
      					<h3><a href="#">Isaac Forson</a></h3>
      					<span class="position">Barber</span>
      					<div class="text">
	        				<p>Professionally trained barber.</p>
	        			</div>
      				</div>
        		</div>
        	</div>
        	<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url(images/staff/staff1.jpg);"></div>
      				<div class="info text-center">
      					<h3><a href="#">Anna Jacobson</a></h3>
      					<span class="position">Makeup Artist</span>
      					<div class="text">
	        				<p>Well trained makeup specialist.</p>
	        			</div>
      				</div>
        		</div>
        	</div>
        	<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url(images/staff/staff3.jpg);"></div>
      				<div class="info text-center">
      					<h3><a href="#">Sarah Boateng</a></h3>
      					<span class="position">Nail Specialist</span>
      					<div class="text">
	        				<p>Well trained specialist.</p>
	        			</div>
      				</div>
        		</div>
        	</div>
        </div>
      </div>
    </section>

		

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Our Work</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row">
        	<div class="col-md-4 ftco-animate">
        		<a href="#" class="work-entry">
        			<img src="images/work-1.jpg" class="img-fluid" alt="Colorlib Template">
        			<div class="info d-flex align-items-center">
        				<div>
        					<div class="icon mb-4 d-flex align-items-center justify-content-center">
        						<span class="icon-search"></span>
        					</div>
		        			<h3>Lips Makeover</h3>
	        			</div>
        			</div>
        		</a>
        	</div>
        	<div class="col-md-4 ftco-animate">
        		<a href="#" class="work-entry">
        			<img src="images/work-2.jpg" class="img-fluid" alt="Colorlib Template">
        			<div class="info d-flex align-items-center">
        				<div>
        					<div class="icon mb-4 d-flex align-items-center justify-content-center">
        						<span class="icon-search"></span>
        					</div>
		        			<h3>Hair Style</h3>
	        			</div>
        			</div>
        		</a>
        	</div>
        	<div class="col-md-4 ftco-animate">
        		<a href="#" class="work-entry">
        			<img src="images/work-3.jpg" class="img-fluid" alt="Colorlib Template">
        			<div class="info d-flex align-items-center">
        				<div>
        					<div class="icon mb-4 d-flex align-items-center justify-content-center">
        						<span class="icon-search"></span>
        					</div>
		        			<h3>Makeup</h3>
	        			</div>
        			</div>
        		</a>
        	</div>
        </div>
    	</div>
    </section>

    <section class="ftco-partner bg-light">
    	<div class="container">
    		<div class="row partner justify-content-center">
    			<div class="col-md-10">
    				<div class="row">
		        	<div class="col-md-3 ftco-animate">
		        		<a href="#" class="partner-entry">
		        			<img src="images/partner-1.jpg" class="img-fluid" alt="Colorlib template">
		        		</a>
		        	</div>
		        	<div class="col-md-3 ftco-animate">
		        		<a href="#" class="partner-entry">
		        			<img src="images/partner-2.jpg" class="img-fluid" alt="Colorlib template">
		        		</a>
		        	</div>
		        	<div class="col-md-3 ftco-animate">
		        		<a href="#" class="partner-entry">
		        			<img src="images/partner-3.jpg" class="img-fluid" alt="Colorlib template">
		        		</a>
		        	</div>
		        	<div class="col-md-3 ftco-animate">
		        		<a href="#" class="partner-entry">
		        			<img src="images/partner-4.jpg" class="img-fluid" alt="Colorlib template">
		        		</a>
		        	</div>
	        	</div>
	        </div>
        </div>
    	</div>
    </section>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Beauty Pricing</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row">
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Basic</h3>
	        			<p><span class="price">$24.50</span> <span class="per">/ one trip</span></p>
	        		</div>
        			<ul>
        				<li>Nail Cutting &amp; Styling</li>
								<li>Hair Trimming</li>
								<li>Spa Therapy</li>
								<li>Body Massage</li>
								<li>Manicure</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        		</div>
        	</div>
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Standard</h3>
	        			<p><span class="price">$34.50</span> <span class="per">/ one trip</span></p>
	        		</div>
        			<ul>
        				<li>Nail Cutting &amp; Styling</li>
								<li>Hair Trimming</li>
								<li>Spa Therapy</li>
								<li>Body Massage</li>
								<li>Manicure</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        		</div>
        	</div>
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry active pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Premium</h3>
	        			<p><span class="price">$54.50</span> <span class="per">/ one trip</span></p>
	        		</div>
        			<ul>
        				<li>Nail Cutting &amp; Styling</li>
								<li>Hair Trimming</li>
								<li>Spa Therapy</li>
								<li>Body Massage</li>
								<li>Manicure</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        		</div>
        	</div>
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Platinum</h3>
	        			<p><span class="price">$89.50</span> <span class="per">/ one trip</span></p>
	        		</div>
        			<ul>
        				<li>Nail Cutting &amp; Styling</li>
								<li>Hair Trimming</li>
								<li>Spa Therapy</li>
								<li>Body Massage</li>
								<li>Manicure</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        		</div>
        	</div>
        </div>
			</div>
		</section>

		<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_4.jpg);">
			<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
        	<div class="col-md-10">
        		<div class="row">
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="flaticon-flower"></span></div>
		              	<span>Makeup Over Done</span>
		                <strong class="number" data-number="3500">0</strong>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="flaticon-flower"></span></div>
		              	<span>Procedure</span>
		                <strong class="number" data-number="1000">0</strong>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="flaticon-flower"></span></div>
		              	<span>Happy Client</span>
		                <strong class="number" data-number="3000">0</strong>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="flaticon-flower"></span></div>
		              	<span>Skin Treatment</span>
		                <strong class="number" data-number="900">0</strong>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
        </div>
      </div>
    </section>


    <footer class="ftco-footer ftco-section img">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Connect with us</h2>

              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Location</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">A55 Obenyaade St.  Tema Comm.11, Accra, GHANA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website was made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Sofia Concepts</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>