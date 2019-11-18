<?php
  // Start the session
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
  </head>

  <body>

    <!-- Start with php script -->
    <?php            
            
            //Redirrect if someone is already logged in
            if (isset($_SESSION['logged_in_client'])) {
              header('Location: index.php');
            }

            require("databaseHelper.php");
            require("formHandling.php");

            header("index.php");

            $db = new databaseHelper();

            $signInValid = false;

            // Add variables for each form input
            $email = $password = "";

            $email_error = $password_error = $signin_error = "";

            
            // Check for form submission and handle form
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

              // Toggle sign in validity before starting checks
              $signInValid = true;

              // Validate Email
              if (empty($_POST['email'])){
                $email_error = "* Enter email to login";
                $signInValid = false;
              }else {
                $email = FormHandler:: sanitizeHtmlInput($_POST['email']);
              }
              
              // Validate Password

              if (empty($_POST['password'])) {
                $password_error = "Enter password to login";
                $signInValid = false;
              }else {
                $password = $_POST['password'];
              }
              
              // Attempt login if both username and password have been entered
              if ($signInValid) {
                $client = $db->login($email, $password);

                if (empty($client)){
                  $signin_error = "* Email or password was incorrect";
                  $password = "";       // Clear the entered password
                  $signInValid = false;
                }else{
                  //Log in wass successful. Assign Session Variable
                  $_SESSION['logged_in_client'] = $client;
                }
              }
            }


            // If this point is reached, the sign in was valid. Navigate to application home page
            if ($signInValid){
              if (isset($_SESSION['login_return_url'])){
                header('Location: ' . $_SESSION['login_return_url']);     //redirrect to viewed page before user decided to login
              }else {
                header('Location: index.php');
              }
            }
              
          ?>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Allure</a>
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
            <li class="nav-item"><a href="testimonials.html" class="nav-link">Testimonials</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

		<section class="ftco-section ftco-appointment">
      <div class="overlay"></div>
      <div class="container">
        <div class="row d-md-flex align-items-center d-flex justify-content-center">
          <!-- <div class="col-md-2"></div> -->
          <div class="col-6 d-flex align-self-stretch ftco-animate">
            <div class="appointment-info text-center p-5">

                <h2 class="mb-3">Login</h2>
                
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="appointment-form">                              

                    <div class="row form-group d-flex justify-content-center">
                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" value="<?php echo $email ?>" placeholder="Email">
                            <span class="form-error" style="color: red;"><?php echo $email_error;?></span>
                        </div>                        
                    </div>

                    <div class="row form-group d-flex justify-content-center">
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="password" value="<?php echo $password ?>" placeholder="Password">
                            <span class="form-error" style="color: red;"><?php echo $password_error;?></span>
                        </div>                        
                    </div>

                    <span class="form-error" style="color: red;"><?php echo $signin_error;?></span>
                    
                    
                    <div class="form-group my-5">
                        <input type="submit" value="Sign In" class="btn btn-white btn-outline-white py-3 px-4">
                    </div>

                    <div>
                      <p>Are you new? <a href="signup.php" style="color: black"><u>Sign up</u></a> today</p>
                    </div>
                </form>
              
            </div>
          </div>             
        </div>
      </div>
    </section>
    
    
    <footer class="ftco-footer ftco-section img">
        <div class="row">
          <div class="col-md-12 text-center">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | ALLURE</a></p>
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