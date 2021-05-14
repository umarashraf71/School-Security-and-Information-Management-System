<?php

session_start();
include('../includes/config.php');
date_default_timezone_set("Asia/Karachi");

//echo $_POST['presentId'];
//echo $_POST['presentId'];


if(isset($_POST['presentId1']) && !empty($_POST['presentId1']) )
{
    $presentId1 = $_POST['presentId1'];

    $query = "update student_attendence set status = 'present' where s_a_id = '$presentId1' ";
    $result = mysqli_query($con, $query);


}


if(isset($_POST['leaveId1']) && !empty($_POST['leaveId1']))
{
    $leaveId1 = $_POST['leaveId1'];

    $query = "update student_attendence set status = 'leave' where s_a_id = '$leaveId1' ";
    $result = mysqli_query($con, $query);


}


if(isset($_POST['absentId1']) && !empty($_POST['absentId1']))
{
    $absentId1 = $_POST['absentId1'];

    $query = "update student_attendence set status = 'absent' where s_a_id = '$absentId1' ";
    $result = mysqli_query($con, $query);


}







if(isset($_POST['presentId']) && !empty($_POST['presentId']) )
{
    $presentId = $_POST['presentId'];

    $query = "update student_attendence set status = 'present' where s_a_id = '$presentId' ";
    $result = mysqli_query($con, $query);

    // $lastId = mysqli_insert_id($con);

    $query1 = "select * from student_attendence where s_a_id = '$presentId'";
    $result1 = mysqli_query($con, $query1);
     
    
    if($result1)
    {
        $row1 = mysqli_fetch_array($result1);
        $status = $row1['status'];
        echo $status;
    }
}


if(isset($_POST['leaveId']) && !empty($_POST['leaveId']))
{
    $leaveId = $_POST['leaveId'];

    $query = "update student_attendence set status = 'leave' where s_a_id = '$leaveId' ";
    $result = mysqli_query($con, $query);

    $query1 = "select * from student_attendence where s_a_id = '$leaveId'";
    $result1 = mysqli_query($con, $query1);
     
    
    if($result1)
    {
        $row1 = mysqli_fetch_array($result1);
        $status = $row1['status'];
        echo $status;
    }
}


if(isset($_POST['absentId']) && !empty($_POST['absentId']))
{
    $absentId = $_POST['absentId'];

    $query = "update student_attendence set status = 'absent' where s_a_id = '$absentId' ";
    $result = mysqli_query($con, $query);

    $query1 = "select * from student_attendence where s_a_id = '$absentId'";
    $result1 = mysqli_query($con, $query1);
     
    
    if($result1)
    {
        $row1 = mysqli_fetch_array($result1);
        $status = $row1['status'];
        echo $status;
    }
}













?>