<?php

session_start();
include('../includes/config.php');

if( isset($_POST['studentcnic']) && !empty($_POST['studentcnic'])) {

	$cnic1= $_POST['studentcnic']; 
	

	$cnicLength1 = strlen($cnic1);

	if($cnicLength1 < 15) 
	{
		echo "<span style='color:red'>Please enter 13 digit B-Form No !</span>";
 		echo "<script>$('#submit').prop('disabled',true);</script>";
	}
	else{

		$cnic1 = preg_replace('/[^0-9]/', '', $cnic1);

		$result =mysqli_query($con,"SELECT b_form FROM student WHERE b_form='$cnic1' ");
		$count=mysqli_num_rows($result);

		if($count>0)
		{
		echo "<span style='color:red'> B-Form No already exists !</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
		} else{
			
			echo "<span style='color:green'> B-Form No available for Registration</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
		}

	}


}




if( isset($_POST['teachercnic']) && !empty($_POST['teachercnic'])) {

	$cnic1= $_POST['teachercnic']; 
	

	$cnicLength1 = strlen($cnic1);

	if($cnicLength1 < 15) 
	{
		echo "<span style='color:red'>Please enter 13 digit Cnic !</span>";
 		echo "<script>$('#submit').prop('disabled',true);</script>";
	}
	else{

		$cnic1 = preg_replace('/[^0-9]/', '', $cnic1);

		$result =mysqli_query($con,"SELECT cnic FROM teacher WHERE cnic = '$cnic1' ");
		$count=mysqli_num_rows($result);

		if($count>0)
		{
		echo "<span style='color:red'> Cnic already exists !</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
		} else{
			
			echo "<span style='color:green'> Cnic available for Registration</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
		}

	}


}



if( isset($_POST['staffcnic']) && !empty($_POST['staffcnic'])) {

	$cnic1= $_POST['staffcnic']; 
	

	$cnicLength1 = strlen($cnic1);

	if($cnicLength1 < 15) 
	{
		echo "<span style='color:red'>Please enter 13 digit Cnic !</span>";
 		echo "<script>$('#submit').prop('disabled',true);</script>";
	}
	else{

		$cnic1 = preg_replace('/[^0-9]/', '', $cnic1);

		$result =mysqli_query($con,"SELECT cnic FROM staff WHERE cnic = '$cnic1' ");
		$count=mysqli_num_rows($result);

		if($count>0)
		{
		echo "<span style='color:red'> Cnic already exists !</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
		} else{
			
			echo "<span style='color:green'> Cnic available for Registration</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
		}

	}


}


if( isset($_POST['visitorcnic']) && !empty($_POST['visitorcnic'])) {

	$cnic1= $_POST['visitorcnic']; 
	

	$cnicLength1 = strlen($cnic1);

	if($cnicLength1 < 15) 
	{
		echo "<span style='color:red'>Please enter 13 digit Cnic !</span>";
 		echo "<script>$('#submit').prop('disabled',true);</script>";
	}
    else{

		echo "<script>$('#submit').prop('disabled',false);</script>";
    }



}



?>