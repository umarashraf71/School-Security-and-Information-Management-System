<?php
ob_start();

require_once('./SmsController.php');

if((isset($_POST['mno']) && trim($_POST['mno']) != null) && (isset($_POST['msg']) && trim($_POST['msg'])!=null ))
{
    $phone = $_POST['mno'];
    $message = $_POST['msg'];

    //echo "Phone: $phone Message: $message <br>";

    $initiator = new SmsController($phone,$message);

    $initiator->sendMessage();

}else{
    echo "<script>alert('Please enter mobile number or message');</script>";
    echo "<script>window.location.href='sms.php';</script>";
}