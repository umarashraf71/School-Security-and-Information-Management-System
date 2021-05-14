<?php

define('DB_SERVER',"localhost");
define('DB_USER',"root");
define('DB_PASSWORD',"");
define('DB_NAME',"sims");


$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);


if(mysqli_connect_errno())
{
    die('Connection Unsuccessfull ' . mysqli_connect_errno());    
}


?>