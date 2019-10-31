 <?php

    //declare variables for my database connection 

    define('SERVERNAME', 'localhost');

    define('USERNAME', 'root');

    define('PASSWORD', '');

    define('DATABASE', 'tsc2021');

 

    //connection 

    $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE);

 

    // Check connection

    if (!$connection) {

        die("Connection failed: " . mysqli_connect_error());

    }else{
         header("location: index.html");
        //echo "connected to the database<br>";

    }



    //check button on the booking page

    if (isset($_POST['lclicked'])) {

    	$cfname = $_POST['Clientfname'];

        $clname = $_POST['Clientlname'];

        $date = $_POST['appointment_date'];

        $phonenumber = $_POST['phone'];

        $service= $_POST['serviceOption'];
        //echo $service;
 

        // create sql query to insert client into database

        $sql = "INSERT into client (client_firstname, client_lastname, phone_number) values('$cfname', '$clname', $phonenumber)";

        mysqli_query($connection, $sql);

        //echo $sql;

         $result = mysqli_query($connection, "select count(1) FROM client");
         $row = mysqli_fetch_array($result);

         $clnum = $row[0];
        //echo $clnum;


        $app = "INSERT INTO appointment(date_of_appointment,service_id,cl_id) VALUES('$date','$service', '$clnum')";
        //run the query and store result

        $results = mysqli_query($connection, $app);
 

        // close database connection
        mysqli_close($connection);

        
 

    }

    if(isset($_POST['tclick'])) {

        // get the submitted username and password
        $cfname = $_POST['Clientfname'];

        $clname = $_POST['Clientlname'];

        $phonenumber = $_POST['phonenumber'];

        $subj = $_POST['subject'];

        $message=$_POST['Message'];

        // echo $message;

        // echo $subj;

 

        // create sql query to insert testimonial details into the database
        $sql = "INSERT into client (client_firstname, client_lastname, phone_number) values('$cfname', '$clname', '$phonenumber')"; 
        //echo $sql;
        $results = mysqli_query($connection, $sql);


         $res = mysqli_query($connection, "select count(1) FROM client");
         $rows = mysqli_fetch_array($res);

         $cnumber = $rows[0];

        $test = "INSERT INTO testimonial(subject,cID, message) VALUES('$subj','$cnumber','$message')";

         // //run the query and store result

        $testimonial = mysqli_query($connection, $test);

 
        //check if results were retrieved

        if ($results > 0 or $testimonial > 0) {

            echo "Thank you, your submission has been received";

            // redirect user to index page

            header("location: index.html"); 

        } else {
            echo "Registration Failed.";


            // redirect user to register page
            //header("location: index.html");

        }

 

        // close database connection
        mysqli_close($connection);


    }
    
?>