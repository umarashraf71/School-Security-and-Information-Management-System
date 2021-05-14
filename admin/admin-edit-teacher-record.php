<?php

include('includes/header.php');

if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from teacher where t_id = '$editId'";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);

    $dob_date = date('Y-m-d', $row['dob']);
    //$dob_date = substr($dob_date,0,17);

}

if(isset($_POST['submit']))
{

    $teacherName = $_POST['tname'];
    $teacherContact = $_POST['tcontact'];
    $teacherAddress = $_POST['taddress'];
    $teacherEmailAddress = $_POST['temailaddress'];
    $teacherQualification = $_POST['tqualification'];
    $teacherGender = $_POST['tgender'];
    $teacherBlood = $_POST['tblood'];

    $DOB = strtotime($_POST['DOB']);

    //storing image name in database and image uploads folder
    $file = $_FILES['file']['name']; //file name to save in database
    $tmp_name = $_FILES['file']['tmp_name'];
    $path = "uploads/".$file;
    move_uploaded_file($tmp_name, $path);


    if($file !== "")
    {
         $query = "update teacher set name = '$teacherName', contact = '$teacherContact', address = '$teacherAddress', email = '$teacherEmailAddress', qualification = '$teacherQualification', gender = '$teacherGender', blood_group = '$teacherBlood', dob = '$DOB', image = '$file' where t_id = '$editId' ";   
    }
    else
    {
        $query = "update teacher set name = '$teacherName', contact = '$teacherContact', address = '$teacherAddress', email = '$teacherEmailAddress', qualification = '$teacherQualification', gender = '$teacherGender', blood_group = '$teacherBlood', dob = '$DOB' where t_id = '$editId' "; 
    }

    $result = mysqli_query($con, $query);

    if($result)
    {
        $msg="Teacher ". $teacherName . " details updated Successfully";
        $_SESSION['successMsg'] = $msg;
        header('location:admin-view-edit-teacher-record.php');
    }

}






?>  

<title> Admin | Edit Teacher Record </title>

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
                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Edit Teacher Record</h4>
                                <h5 class="card-subtitle">Edit Teacher Information</h5>
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
                <small>TEACHER</small>    
            </div>

            <!-- <div class="form-group">
                <label for="title">Teacher CNIC : </label>
                <input type="text" value="" name="teachercnic" class="form-control" id="teachercnic"
                    placeholder="Enter CNIC i.e 35603-2006787-1" required />
            </div> -->

            <div class="form-group">
                <label for="title">Teacher Name : </label>
                <input type="text" value="<?php echo $row['name']; ?>" name="tname" class="form-control" id="tname"
                    placeholder="Enter Teacher Name" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
					&& event.charCode < 123) || (event.charCode == 32)" />
            </div>

            <div class="form-group">
                <label for="title">Date of Birth : </label>
                <input type="date" value="<?php echo $dob_date; ?>" name="DOB" class="form-control" id="DOB"
                    placeholder="Select Date of Birth" required />
            </div>

            <div class="form-group">
                <label for="title">Teacher Contact No : </label>
                <input type="text" value="<?php echo $row['contact']; ?>" name="tcontact" class="form-control" id="tcontact"
                    placeholder="Enter Teacher Contact No" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Residential Address :</label>
                <input type="text" value="<?php echo $row['address']; ?>" name="taddress" class="form-control" id="taddress"
                    placeholder="Enter Resedential Address" required />
            </div>

            <div class="form-group">
                <label for="title">Email Address :</label>
                <input type="email" value="<?php echo $row['email']; ?>" name="temailaddress" class="form-control" id="temailaddress"
                    placeholder="Enter Email Address" required />
            </div>

            <div class="form-group">
                <label for="title">Qualification :</label>
                <input type="text" value="<?php echo $row['qualification']; ?>" name="tqualification" class="form-control" id="tqualification"
                    placeholder="Enter Teacher Qualification" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
					&& event.charCode < 123) || (event.charCode == 32)" />
            </div>


            <div class="form-group">
                <label for="tgender" >Select Gender</label>
                <select class="form-control" name="tgender" id="tgender" required>
                
                <option value="">Select Gender</option>
                
                <option value="male" <?php if($row['gender']=="male") echo 'selected="selected"'; ?> >Male</option>
                <option value="female" <?php if($row['gender']=="female") echo 'selected="selected"';?> >Female</option>
                <option value="others" <?php if($row['gender']=="others") echo 'selected="selected"';?> >Others</option>
                </select>
            </div>



            <div class="form-group">
                <label for="tblood" >Select Blood Group</label>
                <select class="form-control" name="tblood" id="tblood" required>
                    
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



             <!-- get hiring date in the database with current timestamp -->


            <div class="form-group mt-4">
                <label for="file">Upload Teacher Image :</label> <br>
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

