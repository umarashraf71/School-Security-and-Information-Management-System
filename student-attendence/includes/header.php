
<?php

include('config.php');

session_start();

include('check-login.php');

check_login();

date_default_timezone_set("Asia/Karachi");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon Image -->
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/images/favicon.png"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    
    <!-- Google Fonts --> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
	
    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    

    <title>Dashboard</title>     

  </head>

  <body>
							<!-- Scroll to top Button -->
							<a href="#top" class="scroll-top"><i class="fas fa-chevron-up"></i></a>
