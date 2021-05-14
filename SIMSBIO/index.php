<?php
include 'dbConnection.php';
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
.alerts {
  position: absolute;
  top: 30px;
  left: 20px;
  right: 20px;
}
</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TIME ATTENDANCE</title>
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" /> 
</head>
<body>
 
  <br>
  <br>
  <br>
  <br>
<section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="" method="post" autocomplete="off"> 
                                <h1>Time Attendace Login</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                              
                                <p class="login button"> 
                                    <input type="submit" value="Login" name="logs"/> 
                </p>
                                
                            </form>
                        </div>
</body>
</html>

<?php
// ob_start();
 if(isset($_POST['logs'])){
    $idnum=$_POST['username'];
    $pword=$_POST['password'];
				
						$query = "SELECT * FROM authentications WHERE username='$idnum' AND password='$pword'";
						$result=mysqli_query($conn,$query);
						$user=mysqli_fetch_assoc($result);
						if (count($user)>0)
						{
							$_SESSION['id']=$user['id'];
							$_SESSION['uname']=$user['username'];
							if (isset($_SESSION['id']))
							{

// echo "<script>alert('Welcome')</script>";
echo "<script>setTimeout(\"location.href = './test.php';\",1500);</script>";
// exit();
                // echo "<script> location.replace('test.php'); </script>";
                // header('location:test.php');
                            }else{
                              echo "<script type='text/javascript'>";
                              echo "alert('session setting failed');";
                              echo "window.location.href = './index.php';";
                              echo "</script>";
							}
											
						}else{              
              
              echo "<script type='text/javascript'>";
        echo "alert('Login Credentials Are Not Valid!');";
        echo "window.location.href = './index.php';";
        echo "</script>";
            
              //  "<div class='alert alert-info'>Login Credentials Are Not Valid!</div>";
								}
    }
    ?>
    
 <?php
if(isset($_POST['apply'])){
    $fname=$_POST['usernamesignup'];
     $fnames=$_POST['fnamesignup']; 
      $idnum=$_POST['emailsignup'];
    $service=$_POST['passwordsignup'];
 
 
    $queryaa="INSERT INTO authentications VALUES (NULL,'$fname','$idnum','$fnames', '$service')";
    $queryaaa=mysqli_real_query($conn, $queryaa);
   if(!$queryaaa){
       echo mysqlI_error($conn);
    // echo "<script type='text/javascript'>";
    // echo "alert('error!');".mysql_error($conn);
    // echo "</script>";
    //  echo "<div class='text-warning alert alert-warning'><b>Not Sent</b></div> ";
   }else{
       echo "<div style='position:absolute; top:0px; left:0px;' class='alerts'><b>Details saved! Proceed to Login.</div>";
   }
  }
       
?>