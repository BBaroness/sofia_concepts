<?php
  // Start the session
  session_start();

  $_SESSION['login_return_url'] = 'testimonials.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Allure - Testimonials</title>
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

    <?php

      // Do some form validation
      include_once("databaseHelper.php");
      include_once("formHandling.php");

      header("index.php");

      $db = new databaseHelper();

      $commentValid = false;


      // Add variables for each form input
      $subject = $message = "";

      $subject_error = $message_error = "";

      
      // Check for form submission and handle form
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Toggle sign in validity before starting checks
        $commentValid = true;

        // Validate Subject
        if (empty($_POST['subject'])){
          $subject_error = "* Entering a subject helps us group comments/testimonials. Give a short summary of your sentiment.";
          $commentValid = false;
        }else {
          $subject = FormHandler:: sanitizeHtmlInput($_POST['subject']);
        }
        
        // Validate Comment

        if (empty($_POST['message'])) {
          $message_error = "Please enter your comment";
          $commentValid = false;
        }else {
          $message = $_POST['message'];
        }        
        
      }


      // If this point is reached, the comment/testimonial was valid. Insert data into the database
      if ($commentValid){
        $db = new databaseHelper();
        $db->createTestimonial($_SESSION['logged_in_client']['id'], $subject, $message);
        $db->_destruct();

        if (isset($_SESSION['login_return_url'])){
          header('Location: ' . $_SESSION['login_return_url']);     //redirrect to viewed page before user decided to login
        }else {
          header('Location: index.php');
        }
      }

    ?>

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
							<a class="dropdown-item" href="client/appointments.php">My Appointments</a>
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
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Our Work</h2>
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
                  <h3>Facials</h3>
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
                  <h3>(Eye)Facials</h3>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="#" class="work-entry">
              <img src="images/work-4.jpg" class="img-fluid" alt="Colorlib Template">
              <div class="info d-flex align-items-center">
                <div>
                  <div class="icon mb-4 d-flex align-items-center justify-content-center">
                    <span class="icon-search"></span>
                  </div>
                  <h3>Hair Care</h3>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="#" class="work-entry">
              <img src="images/work-5.jpg" class="img-fluid" alt="Colorlib Template">
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
              <img src="images/work-6.jpg" class="img-fluid" alt="Colorlib Template">
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
          <div class="col-md-4 ftco-animate">
            <a href="#" class="work-entry">
              <img src="images/nailsss.jpg" class="img-fluid" alt="Colorlib Template">
              <div class="info d-flex align-items-center">
                <div>
                  <div class="icon mb-4 d-flex align-items-center justify-content-center">
                    <span class="icon-search"></span>
                  </div>
                  <h3>Nails Makeover</h3>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="#" class="work-entry">
              <img src="images/nails3.jpg" class="img-fluid" alt="Colorlib Template">
              <div class="info d-flex align-items-center">
                <div>
                  <div class="icon mb-4 d-flex align-items-center justify-content-center">
                    <span class="icon-search"></span>
                  </div>
                  <h3>Nails</h3>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="#" class="work-entry">
              <img src="images/nails2.jpg" class="img-fluid" alt="Colorlib Template">
              <div class="info d-flex align-items-center">
                <div>
                  <div class="icon mb-4 d-flex align-items-center justify-content-center">
                    <span class="icon-search"></span>
                  </div>
                  <h3>Nails</h3>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section" id="testimonial_section">
      <h3>
        <center>Comments/Testimonials</center></h3>
        <div class="container mt-5">
          <div class="row block-9">
						<div class="col-md-4 contact-info ftco-animate">
							<div class="row">
                <br>
		            
		            <div class="col-md-12 mb-3">
		              <p><span>Phone:</span> <a href="tel://1234567920">+2330 2122 234</a></p>
		            </div>
		            <div class="col-md-12 mb-3">
		              <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@allurebeauty.com</a></p>
		            </div>
		            <div class="col-md-12 mb-3">
		              <p><span>Website:</span> <a href="#">allurebeauty.com</a></p>
		            </div>
							</div>
						</div>
            <div class="col-md-1"></div>  
            

            <?php if ($commentValid): ?>     <!-- Display Thank you message if the form has been submitted successfully -->

              <div class="flex justify-content-center">
                <div class="col-12">
                  <h3 class="" style="color: black;">Thanks for submitting feedback. We truly appreciate this.</h3>
                </div>
                <div class="col-md-6 ftco-animate">
                  <a href="index.php" class="btn btn-primary my-3 py-2 px-4">Visit Home</a><br>
                </div>                           
              </div> 
            
            <?php elseif (!isset($_SESSION['logged_in_client'])): ?>            <!-- If user isn't logged in  tell them to -->
              <div class="flex justify-content-center">
                <div class="col-12">
                  <h3 class="" style="color: black;">Sorry... You need to login first</h3>
                </div>
                <div class="col-md-6 ftco-animate">
                  <a href="login.php" class="btn btn-primary my-3 py-2 px-4">Sign In</a><br>
                </div>
                  
                <div class="col-12">
                  <p style="color: black">Are you new here? <a href="signup.php" style="color: pink"><u>Sign up</u></a> instead</p>
                </div>                              
              </div>             

            <?php else: ?>            <!-- If they are logged in, then they can book an appointment -->
              <div class="col-md-6 ftco-animate">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "#testimonial_section";?>" method="post" class="contact-form">
                  <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $subject ?>" name="subject" placeholder="Subject">
                    <span class="form-error" style="color: red;"><?php echo $subject_error;?></span>
                  </div>
                  <div class="form-group">
                    <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message"><?php echo $message?></textarea>
                    <span class="form-error" style="color: red;"><?php echo $message_error;?></span>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Send Testimonial" class="btn btn-primary py-3 px-5">
                  </div>
                </form>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>

      <?php if ($commentValid) { 
        for ($i = 0; $i < 10; $i++) {
          echo "it worked\n";
        }
      }
      ?>



      <!-- <div id="map"></div> -->

    <footer class="ftco-footer ftco-section img">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">About Us</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Recent Blog</h2>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
             <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Spa Center</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Body Care</a></li>
                <li><a href="#" class="py-2 d-block">Massage</a></li>
                <li><a href="#" class="py-2 d-block">Hydrotherapy</a></li>
                <li><a href="#" class="py-2 d-block">Yoga</a></li>
                <li><a href="#" class="py-2 d-block">Sauna</a></li>
                <li><a href="#" class="py-2 d-block">Aquazone</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
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
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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