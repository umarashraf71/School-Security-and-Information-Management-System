

<?php

session_start();

// session_unset();

include('includes/config.php');

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $newpassword = $_POST['npass'];
    $confirmpassword = $_POST['cpass'];


    $query = "select * from logins where email = '$email' and type = 'admin' ";
    $result = mysqli_query($con,$query);

    if(!$result)
    {
        echo mysqli_error($con); 
    }

    $rows = mysqli_fetch_array($result);
    

    if($newpassword !== $confirmpassword)
    {
        $redirectPage = "admin-forgot-password.php";

        $HOST = $_SERVER['HTTP_HOST'];
        $URI = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');


        header("location:http://$HOST$URI/$redirectPage");

        $_SESSION['error_msg'] = "New and Confirm Password not Matched !";    

        exit();
    
    }else{

    
        if($rows > 0  )
        {

            $query1 = "update logins set password = '$newpassword' where email = '$email' and type = 'admin' ";

            $result1 = mysqli_query($con, $query1);
            
            if ($result1) 
            {
                $redirectPage = "admin-login.php";

                $HOST = $_SERVER['HTTP_HOST'];
                $URI = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

                $_SESSION['success_msg'] = "Password Reset Successfully !";    
    
                header("location:http://$HOST$URI/$redirectPage");
                exit();    
            
            }
            else
            {
                die(mysqli_error($con));        
            }

        }else{

            $redirectPage = "admin-forgot-password.php";

            $HOST = $_SERVER['HTTP_HOST'];
            $URI = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');


            header("location:http://$HOST$URI/$redirectPage");

            $_SESSION['error_msg'] = "Entered Email do not Exist !";    

            exit();
        }

    }


}


?>




<!DOCTYPE html>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
		
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/login.css">

    <title>SIMS | Admin Reset Password</title>     

  </head>
  
<body>
    

    <div class="d-flex justify-content-center align-items-center login-container">
        <form action="" method="post" autocomplete="off" class="login-form text-center" data-aos="zoom-in" data-aos-duration="2000">
            <h1 class="mb-# font-weight-light text-uppercase">Reset Password </h1>

            <span style="color:red;" >
                <?php 

                        if(isset($_SESSION['error_msg']))
                        {
                            echo htmlentities( $_SESSION['error_msg'] ); 
                            echo htmlentities( $_SESSION['error_msg'] = "" );
                        };
                ?>
            </span>

            <div class="form-group pt-3">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="npass" class="form-control" placeholder="New Password" required>
            </div>

            <div class="form-group">
                <input type="password" name="cpass" class="form-control" placeholder="Confirm Password" required>
            </div>

            <div class="loginButton">
                <input type="submit" value="reset" name="submit" class="btn mt-4 btn-md btn-custom btn-block text-uppercase" >
            </div>
    
        </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="vendor/js/jquery/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
    <script src="vendor/js/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/js/jquery/jquery.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        AOS.init();
    </script>
         

</body>
</html>