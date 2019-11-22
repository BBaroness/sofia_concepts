<?php
  // Continue session on this page
  session_start();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book an Appointment</title>
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

    <script type="text/javascript">
      
      function alertMe(){
        alert("Event was Triggered");
      }


      function removeAvailableTimeslots() {
        let element; 

        while (element = document.getElementsByClassName("generated_timeslot")){
          // Removes an element from the document
          element.parentNode.removeChild(element);
        }
      }


      function getAvailableTimeslots() {
        console.log("I have been called to action");

        if( typeof getAvailableTimeslots.date == 'undefined' ) {
            getAvailableTimeslots.date = "";
        }
        if( typeof getAvailableTimeslots.service_id == 'undefined' ) {
            getAvailableTimeslots.service_id = "";
        }

        // If the values have not changed since this method was last called, return
        if (getAvailableTimeslots.date == document.getElementById('appointment_date_selection')
        && getAvailableTimeslots.service_id == document.getElementById('appointment_service_selection') ){
          return;
        }

        
        // Get the date and service id
        getAvailableTimeslots.date = document.getElementById('appointment_date_selection').value;
        getAvailableTimeslots.service_id = document.getElementById('appointment_service_selection').value;

        if (getAvailableTimeslots.date == "" || getAvailableTimeslots.client_id == "") {
          // Set error message to show user they need to select day and service to choose time slot
          document.getElementById("appointment_time_error").innerHTML = "You need to select a date and service first";
          return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  console.log(this.responseText);
                  console.log(document.getElementById("timeslots_insertion_ref"));

                  // document.getElementById("timeslots_insertion_ref").innerHTML = this.responseText;
                  document.getElementById("timeslots_insertion_ref").insertAdjacentHTML('afterend', this.responseText);
                }
            };
            xmlhttp.open("GET","get_timeslots.php?date=" + getAvailableTimeslots.date + "&service_id=" + getAvailableTimeslots.service_id, true);
            xmlhttp.send();
        }
      }


      document.addEventListener('DOMContentLoaded', init, false);   // Add event listeners after the HTML DOM has been loaded into memory
      
      function init() {
        console.log("initialized");
        document.getElementById('appointment_date_selection').addEventListener('change', getAvailableTimeslots);
        document.getElementById('appointment_service_selection').addEventListener('change', getAvailableTimeslots);
      }     

    </script>
    
  </head>
  <body>

    <!-- Start with php script -->
    <?php

            include_once('classes.php');

            $_SESSION['login_return_url'] = 'booking.php';

            $bookingSent = false;
            $formValid = false;

            $db = new databaseHelper();     // for db stuff

            // Add variables for each form input
            $date = $booking_request = $booked_service = $appointment_time = "";

            $date_error = $booking_request_error = $booked_service_error = "";

            // Get all available services from database
            $availableServices = $db->getServices();
            
            // Check for form submission and handle form
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

              // Toggle signup validity and begin validation
              $formValid = true;

              if (empty($_POST['date'])){
                $date_error = "* Date field cannot be empty"; 
                $formValid = false;               
              }else {
                $date = FormHandler:: sanitizeHtmlInput($_POST['date']);                
              }

              if (empty($_POST['booking_request'])){
                // It is not compulsory to add extra booking info
              }else {
                $booking_request = FormHandler:: sanitizeHtmlInput($_POST['booking_request']);
              }

              if(empty($_POST['booked_service'])) {
                $booked_service_error = "* You need to let us know which of our services you are booking";
                $formValid = false; 
              }else {
                $booked_service = FormHandler::sanitizeHtmlInput($_POST['booked_service']);
              }

              if(empty($_POST['appointment_time'])) {
                $appointment_time_error = "* To book and appointment, choose a time slot";
                $formValid = false; 
              }else {
                $appointment_time = FormHandler::sanitizeHtmlInput($_POST['appointment_time']);                
              }


              if ($formValid){
                // Create a booking with form details
                $bookingSent = $db->createNewBooking($appointment_time, $_SESSION['logged_in_client']['id'], $booked_service, $date);                
              }
                                          
            }

            echo $booked_service;

          ?>



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
            <h1 class="mb-3 mt-5 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Book An Appointment</h1>
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>Booking</span></p>
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
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About Us</a></li>
	          <li class="nav-item"><a href="services.html" class="nav-link">Our Services</a></li>
	          <li class="nav-item active"><a href="booking.php" class="nav-link">Appointment Booking</a></li>
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
		<section class="ftco-section ftco-appointment">
      <div class="overlay"></div>
      <div class="container">
        <div class="row d-md-flex align-items-center">
          <div class="col-md-2"></div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="appointment-info text-center p-5">
              <div>
                <h3 class="mb-3">Opening Hours</h3>
                <p class="day"><strong>Mondays - Fridays</strong></p>
                <span>08:00am - 09:00pm</span>
                <br>
                <br>
                <p class="weekend">Sundays</p>
                <span>02:00pm - 09:00pm</span>
              </div>
              <br>
              <div class="mb-4">
                <h4 class="mb-3">Phone</h4>
                <p class="day"><strong>030 323 456</strong> or <strong>030 986 654</strong></p>
              </div>
            </div>
          </div>


          <?php if ($formValid): ?>            <!-- Display Success Message if user successfully makes a booking-->
            <div class="col-md-6 appointment pl-md-5 ftco-animate">

              <h3 class="" style="color: black">Your booking was done succesfully. See you on <?php echo $date ?>.</h3>

              <a href="index.php" class="btn btn-white btn-outline-white my-3 py-2 px-4">Visit Home</a>
                            
          </div>

          <?php elseif (!isset($_SESSION['logged_in_client'])): ?>            <!-- If user isn't logged in  tell them to-->
            <div class="col-md-6 appointment pl-md-5 ftco-animate">

              <h3 class="" style="color: black">Sorry... You need to login first</h3>

              <a href="login.php" class="btn btn-white btn-outline-white my-3 py-2 px-4">Sign In</a>

              <div>
                <p style="color: white">Are you new here? <a href="signup.php" style="color: black"><u>Sign up</u></a> instead</p>
              </div>
                            
          </div>
            

          <?php else: ?>            <!-- If they are logged in, then they can book an appointment -->
            <div class="col-md-6 appointment pl-md-5 ftco-animate">
              <h3 class="mb-3">Make A Booking</h3>
              
              
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="appointment-form">
                <div class="row form-group d-flex">
                  <div class="col-md-6">
                    <div class="input-wrap">
                      <div class="icon"><span class="ion-md-calendar"></span></div>
                      <input type="text" id="appointment_date_selection" class="form-control" value="<?php echo $date ?>" name="date" placeholder="Date">
                      <span class="form-error" style="color: red;"><?php echo $date_error;?></span>
                    </div>
                  </div>
                </div>

                <div>
                  <label class="mr-sm-2" for="inlineFormCustomSelect" style="color: white;">Choose a service</label>
                  <select class="custom-select form-group" name="booked_service"  id="appointment_service_selection" id="inlineFormCustomSelect">      <!-- Dynamic dropdown for services -->
                    <option value="" selected>Select and option *</option>
                    <?php foreach ($availableServices as $service): ?>
                      <option value="<?php echo $service['id'] ?>" <?php if (isset($booked_service) && $booked_service == $service['id']) echo 'selected' ?> > <?php echo $service['name'] ?> </option>
                    <?php endforeach; ?>
                  </select>

                  <span class="form-error" style="color: red;"><?php echo $booked_service_error;?></span>
                </div>

                <!-- Add select for user to choose available time -->
                <div>
                  <label class="mr-sm-2" for="inlineFormCustomSelect" style="color: white;">Choose a time</label>
                  <select class="custom-select form-group" name="appointment_time" id="inlineFormCustomSelect">
                    <option value="" id="timeslots_insertion_ref">Choose appointment time *</option>
                    <div ></div> <!-- Dynamically generated options go here -->                   

                  </select>

                  <span id="appointment_time_error" class="form-error" style="color: red;"></span>
                </div>


                <div class="form-group">
                  <textarea name="booking_request" id="" cols="30" rows="3" class="form-control" placeholder="Is there any extra info you'd like us to note for your appointment?"><?php echo $booking_request ?></textarea>
                  <span class="form-error" style="color: red;"><?php echo $booking_request_error;?></span>
                </div>
                
                <div class="form-group">
                  <input type="submit" value="Book Now" class="btn btn-white btn-outline-white py-3 px-4">
                </div>
              </form>                         
            </div>

          <?php endif; ?>
          
              
          
          
           
          
          

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