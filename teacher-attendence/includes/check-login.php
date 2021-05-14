<?php
function check_login()
{

    if(strlen($_SESSION['username'])==0)
	{	
		$HOST = $_SERVER['HTTP_HOST'];

		$URI  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
        $redirectPage="./teacher-attendence-login.php";		
		
        $_SESSION["username"]="";
		
        header("Location: http://$HOST$URI/$redirectPage");
	}
}
?>