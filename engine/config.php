<?php 
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

      define("GLOBAL_URL","http://localhost/pemrograman_web/ecommerce-4adm1n/");
      define("HOSTNAME","localhost");
      define("USERNAME","root");
      define("PASSWORD","");
      define("DATABASE","ecommerce");

      $dbconnect = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
      if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
      }
?>