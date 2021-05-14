<?php
function check_login()
{

    if(strlen($_SESSION['username'])==0)
	{	
		$HOST = $_SERVER['HTTP_HOST'];

		$URI  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
        $redirectPage="./staff-attendence-login.php";		
		
        $_SESSION["username"]="";
		
        header("Location: http://$HOST$URI/$redirectPage");
	}
}
?>