<?php
  // Start the session
  session_start();

  session_destroy();

  header('Location: index.php');
?>