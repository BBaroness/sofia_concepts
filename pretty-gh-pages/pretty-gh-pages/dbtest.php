<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>

<body>
  <?php

    require("databaseHelper.php");

    $db = new databaseHelper();

    if ($db->emailUnused("owusu-banahene.osei@ashesi.ed.gh")){
      echo "The email is available";
    }

    /* $db->query('SELECT * FROM accounts WHERE username = ? AND password = ?', array('test', 'test'))->fetchArray(); */

    // INSERT INTO `clients` (`fname`, `lname`, `gender`, `email`, `contact`, `password`) VALUES ('Owusu-Banahene', 'Osei', 'male', 'owusu-banahene.osei@ashesi.edu.gh', '0558434290', 'B@naK!ng');

    // $result = $db->query('SELECT * FROM clients WHERE username = ? AND password = ?', array('test', 'test'))->fetchArray();

    // $result = $db->query('SELECT * FROM clients')->fetchArray();
    // echo "firstname" . $result['fname'];

    // $db->registerClient("Isaac", "Bempah", "male", "bempah@fb.com", "0244444444", "pass1234");
    

  ?>
    <h1>Hello</h1>  
</body>
</html>