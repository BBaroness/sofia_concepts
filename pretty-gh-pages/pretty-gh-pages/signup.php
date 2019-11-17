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

            require("databaseHelper.php");
            require("formHandling.php");

            header("index.php");

            $db = new databaseHelper();

            $signupValid = false;

            // Add variables for each form input
            $fname = $lname = $email = $phone_number = $gender = $password = $password_confirmation = "";

            $fname_error = $lname_error = $phone_number_error = $gender_select_error = $email_error = $password_error = "";

            
            // Check for form submission and handle form
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              // Set sign up validity to true and begin validation
              $signupValid = true;

              // Validate Firstname
              if (empty($_POST['fname'])) {
                $fname_error = "* Firstname field cannot be empty";
                $signupValid = false;
              }else {
                $fname = FormHandler:: sanitizeHtmlInput($_POST['fname']);
              }

              // Validate lastname
              if (empty($_POST['lname'])){
                $lname_error = "* Lastname field cannot be empty";
                $signupValid = false;
              }else {
                $lname = FormHandler:: sanitizeHtmlInput($_POST['lname']);
              }

              // Validate phone number
              if (empty($_POST['phone_number'])){
                $phone_number_error = "* Please add a contact so we can reach you when we need to";
                $signupValid = false;
              }else if (!FormHandler::validatePhoneNumber($_POST['phone_number'])) {
                $phone_number_error = "* Please enter a valid Ghanaian mobile number (without country code). Example... 026716562";
                $signupValid = false;
              }else {
                $phone_number = FormHandler:: sanitizeHtmlInput($_POST['phone_number']);                
              }

              // Validate Email
              if (empty($_POST['email'])){
                $email_error = "* We communicate important information about bookings through email. Please provide a valid email address";
                $signupValid = false;
              }else if(!$db->emailUnused($_POST['email'])){     //if email has already been used
                // Check email availability
                $email_error = "* Sorry. A client account with the email already exists. Use another or sign in instead";
                $signupValid = false;                
              }else {
                $email = FormHandler:: sanitizeHtmlInput($_POST['email']);
              }

              
              // Validate Gender
              if (empty($_POST['gender'])){
                $gender_select_error = "* This field is required";
                $signupValid = false;
              }else {
                $gender = FormHandler:: sanitizeHtmlInput($_POST['gender']);
              }
              

              
              // Validate Password

              if (empty($_POST['password'])) {
                $password_error = "Please enter a password";
                $signupValid = false;
              }else if (!FormHandler::validatePassword($_POST['password'])) {
                $password_error = "Enter a valid password that is at least 8 characters long. Use a mix of lowercase, uppercase, and number characters";
                $signupValid = false;
              }else if (empty($_POST['password_confirmation'])) {
                $password = $_POST['password'];
                $password_error = "Please confirm password by entering it again";
                $signupValid = false;
              }else if($_POST['password'] != $_POST['password_confirmation']){
                $password_error = "Passwords entered did not match.";
                $signupValid = false;
              }else {
                $password = $_POST['password'];
                $password_confirmation = $_POST['password_confirmation'];
              }                                                    
            }

            // If form was valid, Register user and redirect to the login screen
            if ($signupValid){
              $db->registerClient($fname, $lname, $gender, $email, $phone_number, $password);

              header('Location: login.php');
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
          <div class="col-10 d-flex align-self-stretch ftco-animate">
            <div class="appointment-info text-center p-5">

                <h2 class="mb-3">Sign Up</h2>
                
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="appointment-form">
                <div class="row form-group d-flex">
                    <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $fname ?>" name="fname" placeholder="First Name">
                    <span class="form-error" style="color: red;"><?php echo $fname_error;?></span>
                    </div>
                    <div class="col-md-6">
                    <input type="text" class="form-control" name="lname" value="<?php echo $lname ?>" placeholder="Last Name">
                    <span class="form-error" style="color: red;"><?php echo $lname_error;?></span>
                    </div>
                </div>

                <br>
                <br>

                
                <div class="row form-group d-flex">                    
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="phone_number" value="<?php echo $phone_number ?>" placeholder="Phone">
                        <span class="form-error" style="color: red;"><?php echo $phone_number_error;?></span>
                    </div>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="<?php echo $email ?>" placeholder="Email">
                        <span class="form-error" style="color: red;"><?php echo $email_error;?></span>
                    </div>

                    <!-- Add select for user to choose available time -->
                    <div class="col-md-6 py-5">
                      <select class="custom-select form-group" name="gender" id="inlineFormCustomSelect">
                        <option value="">Select Gender</option>
                        <option value="male" <?php if($gender == "male") echo 'selected'; ?> >Male</option>
                        <option value="female" <?php if($gender == "female") echo 'selected'; ?> >Female</option>
                        <option value="other" <?php if($gender == "other") echo 'selected'; ?> >Prefer not to say</option>
                      </select>

                      <span class="form-error" style="color: red;"><?php echo $gender_select_error;?></span>
                    </div>
                </div>
                


                <div class="row form-group d-flex justify-content-center">                    
                    <!-- <div class="col-md-6">
                        <input type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="Username">
                        <span class="form-error" style="color: red;"><?php echo $username_error;?></span>
                    </div> -->

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password" value="<?php echo $password ?>" placeholder="Password">
                        <span class="form-error" style="color: red;"><?php echo $password_error;?></span>
                    </div>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation" value="<?php echo $password_confirmation ?>" placeholder="Confirm Password">
                    </div>
                </div>


                
                <div class="form-group my-5">
                    <input type="submit" value="Register" class="btn btn-white btn-outline-white py-3 px-4">
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