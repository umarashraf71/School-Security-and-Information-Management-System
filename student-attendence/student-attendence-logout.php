<?php

    session_start();
    $_SESSION['username']="";
    session_destroy();
    session_unset();

    header("location:../index.php");
?>