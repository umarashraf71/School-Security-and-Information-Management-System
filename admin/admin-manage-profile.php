<?php

include('includes/header.php');


$query = "select * from staff where type = 'admin' limit 1 ";
$result = mysqli_query($con,$query);

if($result)
{
    $row = mysqli_fetch_array($result);
    $dob_date = date('Y-m-d', $row['dob']);
}

// echo "<h1 style='margin-top:200px !important'> " . $_POST['staffname'] . " </h1>";


if(isset($_POST['submit']))
{


    $staffName = $_POST['staffname'];
    $staffContact = $_POST['staffcontact'];
    $staffAddress = $_POST['address'];
    $staffEmailAddress = $_POST['staffemailaddress'];
    $staffCnic = $_POST['staffcnic'];
    $staffGender = $_POST['staffgender'];
    $staffBlood = $_POST['staffblood'];

    $DOB = strtotime($_POST['DOB']);

    //storing image name in database and image uploads folder
    $file = $_FILES['file']['name']; //file name to save in database
    $tmp_name = $_FILES['file']['tmp_name'];
    $path = "uploads/".$file;
    move_uploaded_file($tmp_name, $path);


    if($file !== "")
    {
        $query1 = "update staff set name = '$staffName', contact = '$staffContact', address = '$staffAddress', email = '$staffEmailAddress', cnic = '$staffCnic', gender = '$staffGender', blood_group = '$staffBlood', dob = '$DOB', image = '$file' where type = 'admin' ";   
    }
    else
    {
        $query1 = "update staff set name = '$staffName', contact = '$staffContact', address = '$staffAddress', email = '$staffEmailAddress', cnic = '$staffCnic', gender = '$staffGender', blood_group = '$staffBlood', dob = '$DOB' where type = 'admin' "; 
    }

    $result1 = mysqli_query($con, $query1);

    if($result1)
    {

        $query2 = "update logins set cnic = '$staffCnic', email = '$staffEmailAddress' where type = 'admin'";
        $result2 = mysqli_query($con, $query2);

        if($result2)
        {
            $msg="Admin ". $staffName . " details updated Successfully !";
            $_SESSION['successMsg'] = $msg;
            header("refresh: 2; url=admin-manage-profile.php");
        }
    }

}


?>  

<title> Admin | Manage Profile  </title>

<div id="wrapper">

<div class="overlay"></div>

<?php

    include('includes/sidebar.php');

?>  


<?php

    include('includes/topbar.php');

?>  

<!-- Page Content -->
<div id="page-content-wrapper">
    
    
<div id="content">


<div class="container-fluid p-0 px-lg-0 px-md-0" >


<!-- Begin Page Content -->
<div class="container-fluid px-lg-4">


<div class="row pt-3">

<!-- Page Heading -->
<!-- <div class="col-md-12 mt-lg-4 mt-5 mb-1">     
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-3 text-gray-800">Add Student Record</h1>
    </div>
</div> -->

      <!-- column -->
      <!-- <div class="offset-md-2 col-md-8 pt-5"> -->
      <div class="form-card-container" >

      <div class="row">

<!-- Notify message	--> 
<?php if(!empty($_SESSION['successMsg'])) { ?>

<div class="alert alert-success 
            text-center offset-md-3 
            col-md-6" id = "message">
    <strong style="font-size:16px;">
        <?php echo htmlentities($_SESSION['successMsg']);?>
        <?php echo htmlentities($_SESSION['successMsg']="");?>
    </strong>
</div>

<?php } ?>

</div>


                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Manage Profile</h4>
                                <h5 class="card-subtitle">Edit Profile Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


        <div class="d-flex align-items-center justify-content-center mb-3 ">
            <img src="uploads/<?php echo $row['image']; ?>" class="w-25" style="border-radius:50% !important; border:2px solid #2e4157"> 
        </div>

        <div class="d-flex flex-column align-items-center justify-content-center headingName mb-4">
        <h4> <?php echo ucfirst($row['name']); ?> </h4>
        <small style="text-transform:uppercase;" ><?php echo $row['type']; ?></small>    
            <a href="admin-manage-admin-password.php" class="btn btn-info" style="margin-top:13px !important">Reset Username & Password </a>
            
        </div>

            <div class="form-group">
                <label for="title">Admin CNIC : </label>
                <input type="text" value="<?php echo $row['cnic']; ?>" name="staffcnic" class="form-control" id="staffcnic"
                    placeholder="Enter CNIC i.e 35603-2006787-1" required />
            </div>

            <div class="form-group">
                <label for="title">Admin Name : </label>
                <input type="text" value="<?php echo $row['name']; ?>" name="staffname" class="form-control" id="staffname"
                    placeholder="Enter Staff Member Name" required />
            </div>

            <div class="form-group">
                <label for="title">Date of Birth : </label>
                <input type="date" value="<?php echo $dob_date; ?>" name="DOB" class="form-control" id="DOB"
                    placeholder="Select Date of Birth" required />
            </div>

            <div class="form-group">
                <label for="title">Contact No : </label>
                <input type="text" value="<?php echo $row['contact']; ?>" name="staffcontact" class="form-control" id="staffcontact"
                    placeholder="Enter Staff Contact No" required />
            </div>

            <div class="form-group">
                <label for="title">Residential Address :</label>
                <input type="text" value="<?php echo $row['address']; ?>" name="address" class="form-control" id="address"
                    placeholder="Enter Resedential Address" required />
            </div>

            <!-- <div class="form-group">
                <label for="title">Staff Member Type :</label>
                <input type="text" value="<?php //echo $row['type']; ?>" name="stafftype" class="form-control" id="stafftype"
                    placeholder="Enter Staff Member Type" required />
            </div> -->
            
        <?php
            
            if($row['email'] !== null || $row['email'] !== "")
            {

        ?>    

            <div class="form-group">
                <label for="title">Email : </label>
                <input type="text" value="<?php echo $row['email']; ?>" name="staffemailaddress" class="form-control" id="staffemailaddress"
                    placeholder="Enter Staff Member Email"  />
            </div>

        <?php

            }
            else
            {
        ?>        
            <div class="form-group">
                <label for="title">Member Email : </label>
                <input type="text" value="" name="staffemailaddress" class="form-control" id="staffemailaddress"
                    placeholder="Enter Staff Member Email"  />
            </div>

        <?php
            }    
        ?>

            <div class="form-group">
                <label for="staffgender" >Select Gender</label>
                <select class="form-control" name="staffgender" id="staffgender" required>
                
                <option value="">Select Gender</option>
                
                <option value="male" <?php if($row['gender']=="male") echo 'selected="selected"'; ?> >Male</option>
                <option value="female" <?php if($row['gender']=="female") echo 'selected="selected"';?> >Female</option>
                <option value="others" <?php if($row['gender']=="others") echo 'selected="selected"';?> >Others</option>
                </select>
            </div>



            <div class="form-group">
                <label for="staffblood" >Select Blood Group</label>
                <select class="form-control" name="staffblood" id="staffblood" required>
                    
                    <option value="">Select Blood Group</option>

                    <option value="A+" <?php if($row['blood_group']=="A+") echo 'selected="selected"';?> >A+</option>
                    <option value="A-" <?php if($row['blood_group']=="A-") echo 'selected="selected"';?> >A-</option>
                    <option value="B+" <?php if($row['blood_group']=="B+") echo 'selected="selected"';?> > B+</option>
                    <option value="B-" <?php if($row['blood_group']=="B-") echo 'selected="selected"';?> >B-</option>
                    <option value="AB+" <?php if($row['blood_group']=="AB+") echo 'selected="selected"';?> >AB+</option>
                    <option value="AB-" <?php if($row['blood_group']=="AB-") echo 'selected="selected"';?> >AB-</option>
                    <option value="O+" <?php if($row['blood_group']=="O+") echo 'selected="selected"';?>>O+</option>
                    <option value="O-" <?php if($row['blood_group']=="O-") echo 'selected="selected"';?> >O-</option>
                </select>
            </div>



             <div class="form-group mt-4">
                <label for="file">Upload Staff Member Image :</label> <br>
                <input type="file" class="form-check-input" id="file" name="file" style="margin-left: 0.05em;"/>
            </div>

            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="up-btn" />
      
        </form>

 
    </div>
</div>
            
        
</div>



         
        </div>
        <!-- /.container-fluid -->
    </div>
            
    

    </div>
    <!-- /#content -->

</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->


<?php

include('includes/footer.php');

?>	


<script>
        setTimeout(function()
			{
				$('#message').fadeOut('fast');
			}, 2500); // <-- time in milliseconds
	</script>