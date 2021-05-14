<?php

    include('includes/header.php');
    

    if(isset($_GET['id']))
    {
        $editId = $_GET['id'];

        $query = "select * from student where s_id = '$editId'";
        $result = mysqli_query($con, $query);

        $row = mysqli_fetch_array($result);

        $dob_date = date('Y-m-d', $row['dob']);
        //$dob_date = substr($dob_date,0,17);

        $studentUneditRollNo = $row['roll_no'];
        $studentUneditClass = $row['class_id'];
        $studentUneditSection = $row['section'];

    }


        if (isset($_POST['submit'])) {
            $studentName = $_POST['Sname'];
            $studentFather = $_POST['FGname'];
            $studentFatherContact = $_POST['FGcontact'];
            $studentAddress = $_POST['address'];
            $studentGender = $_POST['sgender'];
            $studentBlood = $_POST['sblood'];
            $studentClass = $_POST['sclass'];
            $studentSection = $_POST['ssection'];
            $studentFeeType = $_POST['feeType'];

            $DOB = strtotime($_POST['DOB']);

            //storing image name in database and image uploads folder
            $file = $_FILES['file']['name']; //file name to save in database
            $tmp_name = $_FILES['file']['tmp_name'];
            $path = "uploads/".$file;
            move_uploaded_file($tmp_name, $path);


            
            
            ////////////////////////////////////
            //if we change no class and section
            ////////////////////////////////////
            if ($studentUneditClass == $studentClass && $studentUneditSection == $studentSection) 
            {
                if($file !== "")
                {            
                    $query1 = "update student set dob = '$DOB', name = '$studentName', father_name = '$studentFather', father_contact = '$studentFatherContact', address = '$studentAddress', gender = '$studentGender', blood_group = '$studentBlood', class_id = '$studentClass', section = '$studentSection', image = '$file', fee_type = '$studentFeeType' where s_id = '$editId'";
                }
                else{

                    $query1 = "update student set dob = '$DOB', name = '$studentName', father_name = '$studentFather', father_contact = '$studentFatherContact', address = '$studentAddress', gender = '$studentGender', blood_group = '$studentBlood', class_id = '$studentClass', section = '$studentSection', fee_type = '$studentFeeType' where s_id = '$editId'";
                }
                
                $result1 = mysqli_query($con, $query1);
    
                if ($result1) {
                    $msg="Student ". $studentName . " details updated Successfully !";
                    $_SESSION['successMsg'] = $msg;
                    header('location:admin-view-edit-student-record.php');
                }
            }

            


            ////////////////////////////////////////////
            //when class is same and section is changed
            ////////////////////////////////////////////
            if ($studentUneditClass == $studentClass &&  $studentUneditSection !== $studentSection) 
            {

                $query1 = "select * from student where section = '$studentSection' and class_id = '$studentClass' order by s_id desc limit 1";
                $result1 = mysqli_query($con, $query1);
                    
                $row1 = mysqli_fetch_array($result1);
                $studentRollNo = $row1['roll_no'] + 1;


                //check if any image is uploaded or not
                if($file !== "")
                {
                    $query2 = "update student set dob = '$DOB', name = '$studentName', roll_no = '$studentRollNo', father_name = '$studentFather', father_contact = '$studentFatherContact', address = '$studentAddress', gender = '$studentGender', blood_group = '$studentBlood', class_id = '$studentClass', section = '$studentSection', image = '$file', fee_type = '$studentFeeType' where s_id = '$editId'";
                }
                else
                {
                    $query2 = "update student set dob = '$DOB', name = '$studentName', roll_no = '$studentRollNo', father_name = '$studentFather', father_contact = '$studentFatherContact', address = '$studentAddress', gender = '$studentGender', blood_group = '$studentBlood', class_id = '$studentClass', section = '$studentSection', fee_type = '$studentFeeType' where s_id = '$editId'";
                }

                $result2 = mysqli_query($con, $query2);
        
                if ($result2) {
                    $msg="Student ". $studentName . " details updated Successfully 1";
                    $_SESSION['successMsg'] = $msg;
                    header('location:admin-view-edit-student-record.php');
                }
            }
            /////////////////////////////////////////



            ////////////////////////////////////////////////
            //when section is the same but class is changed
            ////////////////////////////////////////////////
            if ($studentUneditClass !== $studentClass &&  $studentUneditSection == $studentSection) 
            {
                $query1 = "select * from student where section = '$studentSection' and class_id = '$studentClass' order by s_id desc limit 1";
                $result1 = mysqli_query($con, $query1);
                    
                $row1 = mysqli_fetch_array($result1);
                $studentRollNo = $row1['roll_no'] + 1;


                //taking out changed class fee
                $query2 = "select * from class where class_id = $studentClass";
                $result2 = mysqli_query($con, $query2);

                if ($result2) {
                    $row2 = mysqli_fetch_array($result2);

                    $monthlyFee = $row2['monthly_fee'];
                    $monthlyTestFee = $row2['monthly_test_fee'];
                    $annualTestFee = $row2['annual_test_fee'];
                    $biseFee = $row2['bise_fee'];


                    //check if any image is uploaded or not
                    if($file !== "")
                    {
                        //update student with new class_id and all the class feeses
                        $query3 = "update student set dob = '$DOB', name = '$studentName', roll_no = '$studentRollNo', father_name = '$studentFather', father_contact = '$studentFatherContact', address = '$studentAddress', gender = '$studentGender', blood_group = '$studentBlood', class_id = '$studentClass', section = '$studentSection', monthly_test_fee = '$monthlyTestFee', monthly_tution_fee = '$monthlyFee', annual_test_fee = '$annualTestFee', bise_fee = '$biseFee', image = '$file', fee_type = '$studentFeeType' where s_id = '$editId'";
                    }
                    else
                    {
                        //update student with new class_id and all the class feeses
                        $query3 = "update student set dob = '$DOB', name = '$studentName', roll_no = '$studentRollNo', father_name = '$studentFather', father_contact = '$studentFatherContact', address = '$studentAddress', gender = '$studentGender', blood_group = '$studentBlood', class_id = '$studentClass', section = '$studentSection', monthly_test_fee = '$monthlyTestFee', monthly_tution_fee = '$monthlyFee', annual_test_fee = '$annualTestFee', bise_fee = '$biseFee', fee_type = '$studentFeeType' where s_id = '$editId'";
                    }

                    $result3 = mysqli_query($con, $query3);

                    if ($result3) {
                        $msg="Student ". $studentName . " details updated Successfully 2";
                        $_SESSION['successMsg'] = $msg;
                        header('location:admin-view-edit-student-record.php');
                    }
                }
            }
            /////////////////////////////////////////




            /////////////////////////////////////////
            //if we change both the class and section
            /////////////////////////////////////////
            if($studentUneditClass !== $studentClass &&  $studentUneditSection !== $studentSection)
            {

                $query1 = "select * from student where section = '$studentSection' and class_id = '$studentClass' order by s_id desc limit 1";
                $result1 = mysqli_query($con, $query1);    
                
                $row1 = mysqli_fetch_array($result1);
                $studentRollNo = $row1['roll_no'] + 1;


                //taking out changed class fee
                $query2 = "select * from class where class_id = $studentClass";
                $result2 = mysqli_query($con, $query2);

                if($result2){

                    $row2 = mysqli_fetch_array($result2);

                    $monthlyFee = $row2['monthly_fee'];
                    $monthlyTestFee = $row2['monthly_test_fee'];
                    $annualTestFee = $row2['annual_test_fee'];
                    $biseFee = $row2['bise_fee'];

                    //update student with new class_id and all the class feeses

                    //check if any image is uploaded or not
                    if($file !== "")
                    {
                        $query3 = "update student set dob = '$DOB', name = '$studentName', roll_no = '$studentRollNo', father_name = '$studentFather', father_contact = '$studentFatherContact', address = '$studentAddress', gender = '$studentGender', blood_group = '$studentBlood', class_id = '$studentClass', section = '$studentSection', monthly_test_fee = '$monthlyTestFee', monthly_tution_fee = '$monthlyFee', annual_test_fee = '$annualTestFee', bise_fee = '$biseFee', image = '$file', fee_type = '$studentFeeType' where s_id = '$editId'";
                    }
                    else
                    {
                        $query3 = "update student set dob = '$DOB', name = '$studentName', roll_no = '$studentRollNo', father_name = '$studentFather', father_contact = '$studentFatherContact', address = '$studentAddress', gender = '$studentGender', blood_group = '$studentBlood', class_id = '$studentClass', section = '$studentSection', monthly_test_fee = '$monthlyTestFee', monthly_tution_fee = '$monthlyFee', annual_test_fee = '$annualTestFee', bise_fee = '$biseFee', fee_type = '$studentFeeType' where s_id = '$editId'";
                    }
                    
                    $result3 = mysqli_query($con, $query3);

                    if($result3)
                    {
                        $msg="Student ". $studentName . " details updated Successfully 3";
                        $_SESSION['successMsg'] = $msg;
                        header('location:admin-view-edit-student-record.php');
                    }
                }
            }
            /////////////////////////////////////////

            

        }

?>  


<title> Admin | Edit Student Record </title>

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
                                    <h4 class="card-title">Edit Student Record</h4>
                                    <h5 class="card-subtitle">Edit Student Information</h5>
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
                <small>STUDENT</small>    
            </div>

                <div class="form-group">
                    <label for="title">Student Name : </label>
                    <input type="text" value="<?php echo $row['name']; ?>" name="Sname" class="form-control" id="Sname"
                        placeholder="Enter Full Name" required 
                        onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
					&& event.charCode < 123) || (event.charCode == 32)" />
                </div>

                <div class="form-group">
                    <label for="title">Father / Gaurdian Name : </label>
                    <input type="text" value="<?php echo $row['father_name']; ?>" name="FGname" class="form-control" id="FGname"
                        placeholder="Enter Father / Gaurdian Name" required 
                        onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
					&& event.charCode < 123) || (event.charCode == 32)" />
                </div>

                <!-- <div class="form-group">
                    <label for="title">Father / Gaurdian Cnic : </label>
                    <input type="text" value="<?php //echo $row['father_cnic']; ?>" name="FGcnic" class="form-control" id="FGcnic"
                        placeholder="Enter Father / Gaurdian Cnic" required maxlength="15"/>
                </div> -->

                <div class="form-group">
                    <label for="title">Father / Gaurdian Contact No : </label>
                    <input type="text" value="<?php echo $row['father_contact']; ?>" name="FGcontact" class="form-control" id="FGcontact"
                        placeholder="Enter Father / Gaurdian Contact No" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>


                <div class="form-group">
                    <label for="title">Date of Birth : </label>
                    <input type="date" value="<?php echo $dob_date; ?>" name="DOB" class="form-control" id="DOB"
                        placeholder="Select Date of Birth" required />
                </div>


                <div class="form-group">
                    <label for="title">Residential Address :</label>
                    <input type="text" value="<?php echo $row['address']; ?>" name="address" class="form-control" id="title"
                        placeholder="Enter Resedential Address" required />
                </div>

                <div class="form-group">
                    <label for="sgender" >Select Gender</label>
                    <select class="form-control" name="sgender" id="sgender" required>
                    <option value="">Select Gender</option>
                    <option value="male" <?php if($row['gender']=="male") echo 'selected="selected"'; ?> >Male</option>
                    <option value="female" <?php if($row['gender']=="female") echo 'selected="selected"';?> >Female</option>
                    <option value="others" <?php if($row['gender']=="others") echo 'selected="selected"';?> >Others</option>
                    </select>
                </div>




                <div class="form-group">
                    <label for="sblood" >Select Blood Group</label>
                    <select class="form-control" name="sblood" id="sblood" required>
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




                <div class="form-group">
                    <label for="sclass" >Select Class</label>
                    <select class="form-control" name="sclass" id="sclass" required>
                    <option value="">Select Class</option>        

                    <?php

                        $query4 = "select * from class";
                        $result4 = mysqli_query($con, $query4);

                        while($row4 = mysqli_fetch_array($result4))
                        {
                    ?>
                                
                        <option value="<?php echo $row4['class_id'] ?>" <?php if($row['class_id']==$row4['class_id']) echo 'selected="selected"';?> >
                            <?php echo ucfirst($row4['class_name']); ?>
                        </option>          

                    <?php
                    
                        }
                    
                    ?>

                    </select>
                </div>




                <div class="form-group">
                    <label for="ssection" >Select Section</label>
                    <select class="form-control" name="ssection" id="ssection" required>
                        <option value="">Select Section</option>
                        <option value="section A" <?php if($row['section']=="section A") echo 'selected="selected"'; ?> >Section A</option>
                        <option value="section B" <?php if($row['section']=="section B") echo 'selected="selected"'; ?> >Section B</option>
                        <option value="section C" <?php if($row['section']=="section C") echo 'selected="selected"'; ?> >Section C</option>
                    </select>
                </div> 


                <div class="form-group">
                    <label for="ssection" >Fee Type</label>
                    <select class="form-control" name="feeType" id="feeType" required>
                        <option value="">Select Fee Type</option>
                        <option value="standard" <?php if($row['fee_type']=="standard") echo 'selected="selected"'; ?> >Standard</option>
                        <option value="scholarship" <?php if($row['fee_type']=="scholarship") echo 'selected="selected"'; ?> >Scholarship</option>
                    </select>
                </div>


                <div class="form-group mt-4">
                    <label for="file">Upload Student Image :</label> <br>
                    <input type="file" class="form-check-input" id="file" value="<?php $row['image'] ?>" name="file" style="margin-left: 0.05em;"/>
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

