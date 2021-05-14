<?php

    include('includes/header.php');

?>  


<title> Admin | Add Student Record </title>


<?php

    if(isset($_POST['submit']))
    {

        $studentName = $_POST['Sname'];
        $studentFather = $_POST['FGname'];
        $studentFatherContact = $_POST['FGcontact'];
        $studentAddress = $_POST['address'];
        $studentGender = $_POST['sgender'];
        $studentBlood = $_POST['sblood'];
        $studentClass = $_POST['sclass'];
        $studentSection = $_POST['ssection'];
        $studentFeeType = $_POST['feeType'];
        $studentAdmissionFee = $_POST['sadmissionfee'];
        $studentBiseFee = $_POST['sbisefee'];
        $studentAnnualTestFee = $_POST['sanuualtestfee'];
        $studentMonthlyTestFee = $_POST['smonthlytestfee'];
        $studentMonthlyTutionFee = $_POST['smonthlytutionfee'];
        
        $miscellaneous_fee = 0;
        $fee_charges = 0;

        //storing image name in database and image uploads folder
        $file = $_FILES['file']['name']; //file name to save in database
        $tmp_name = $_FILES['file']['tmp_name'];
        $path = "uploads/".$file;
        move_uploaded_file($tmp_name, $path);


        if($file === "")
        {
            $file = "user.png";
        }
  

        //getting admission date in UNIX TIMESTAMP
        $today = date("m/d/y");
        $todayUnixDate = strtotime($today);

        // $today = date("d-m-y");
        // $todayUnixDate = strtotime($today);
        
        //GETTING CNIC WITHOUT DASHES
        $studentBForm = $_POST['sbform'];
        $studentBForm = preg_replace('/[^0-9]/', '', $studentBForm);

        //GETTING CNIC WITHOUT DASHES
        $studentFatherCnic = $_POST['FGcnic'];
        $studentFatherCnic = preg_replace('/[^0-9]/', '', $studentFatherCnic);

        //DATE OF BIRTH in UNIX TIMESTAMP
        $DOB = strtotime($_POST['DOB']);
        


        //checking if any student of the particular class or section exists before
        $query1 = "select * from student where section = '$studentSection' and class_id = '$studentClass' ";
        $result1 = mysqli_query($con, $query1);
        $count1 = mysqli_num_rows($result1);


        if($count1 > 0)
        {
            //getting roll no last entered student in a particular class and section and then incrementing 1 in it
            $query2 = "select * from student where section = '$studentSection' and class_id = '$studentClass' order by s_id desc limit 1";
            $result2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_array($result2);

            $studentRollNo = $row2['roll_no'] + 1;


            //inserting all the student record
            $query3 = "insert into student (class_id, section, roll_no, image, name, b_form, father_name, father_cnic, father_contact, dob, address, gender, blood_group, fee_type, admission_fee, bise_fee, annual_test_fee, monthly_test_fee, monthly_tution_fee, admission_date) values ('$studentClass', '$studentSection', '$studentRollNo', '$file', '$studentName', '$studentBForm', '$studentFather', '$studentFatherCnic', '$studentFatherContact', '$DOB', '$studentAddress', '$studentGender', '$studentBlood', '$studentFeeType', '$studentAdmissionFee', '$studentBiseFee', '$studentAnnualTestFee', '$studentMonthlyTestFee', '$studentMonthlyTutionFee', '$todayUnixDate')";

            $result3 = mysqli_query($con, $query3);

            $studentLastId = mysqli_insert_id($con);

            if($result3)
            {
                $total_fee = $studentAdmissionFee + $studentBiseFee + $studentAnnualTestFee + $studentMonthlyTestFee + $studentMonthlyTutionFee;

                $query4 = "insert into student_voucher (s_id, issue_date, status, name, class, section, roll_no, fee_type, admission_fee, bise_fee, annual_test_fee, monthly_test_fee, monthly_tution_fee, total_fee) values ('$studentLastId', '$todayUnixDate', 'due', '$studentName', '$studentClass', '$studentSection', '$studentRollNo', '$studentFeeType', '$studentAdmissionFee', '$studentBiseFee', '$studentAnnualTestFee', '$studentMonthlyTestFee', '$studentMonthlyTutionFee', '$total_fee')";

                $result4 = mysqli_query($con, $query4);
      
                if($result4)
                {
                    $msg="Student ". $studentName . " details added Successfully";
                    $_SESSION['successMsg'] = $msg;
                    header('location:admin-add-student-fingerprint.php?id=' . $studentLastId . '');
                }

            }

        }
        else{


            $studentRollNo = 1;


            //inserting all the student record
            $query3 = "insert into student (class_id, section, roll_no, image, name, b_form, father_name, father_cnic, father_contact, dob, address, gender, blood_group, fee_type, admission_fee, bise_fee, annual_test_fee, monthly_test_fee, monthly_tution_fee, admission_date) values ('$studentClass', '$studentSection', '$studentRollNo', '$file', '$studentName', '$studentBForm', '$studentFather', '$studentFatherCnic', '$studentFatherContact', '$DOB', '$studentAddress', '$studentGender', '$studentBlood', '$studentFeeType', '$studentAdmissionFee', '$studentBiseFee', '$studentAnnualTestFee', '$studentMonthlyTestFee', '$studentMonthlyTutionFee', '$todayUnixDate')";

            $result3 = mysqli_query($con, $query3);

            $studentLastId = mysqli_insert_id($con);

            if($result3)
            {
                $total_fee = $studentAdmissionFee + $studentBiseFee + $studentAnnualTestFee + $studentMonthlyTestFee + $studentMonthlyTutionFee;

                $query4 = "insert into student_voucher (s_id, issue_date, status, name, class, section, roll_no, fee_type, admission_fee, bise_fee, annual_test_fee, monthly_test_fee, monthly_tution_fee, miscellaneous_fee, fine_charges, total_fee) values ('$studentLastId', '$todayUnixDate', 'due', '$studentName', '$studentClass', '$studentSection', '$studentRollNo', '$studentFeeType', '$studentAdmissionFee', '$studentBiseFee', '$studentAnnualTestFee', '$studentMonthlyTestFee', '$studentMonthlyTutionFee', '$miscellaneous_fee', '$fine_charges' '$total_fee')";

                $result4 = mysqli_query($con, $query4);
    
                if($result4)
                {
                    $msg="Student ". $studentName . " details added Successfully";
                    $_SESSION['successMsg'] = $msg;
                    header('location:admin-add-student-fingerprint.php?id=' . $studentLastId . '');
                }
            }

        }

    }

?>



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
                                    <h4 class="card-title">Add Student Record</h4>
                                    <h5 class="card-subtitle">Fill in the Student Admission Form</h5>
                                </div>
                            </div>
                            <!-- title -->
                        </div>
                        

            <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">



                <div class="form-group">
                    <label for="title">Student Name : </label>
                    <input type="text" value="" name="Sname" class="form-control" id="Sname"
                        placeholder="Enter Full Name" required 
                        onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
						&& event.charCode < 123) || (event.charCode == 32)"
                        />
                </div>




                <div class="form-group">
                    <label for="title">Student B-Form No : </label>
                    <input type="text" value="" name="sbform" class="form-control" id="scnic" maxlength="15"
                        placeholder="Enter B-Form No i.e 37584-6885986-1" required 
                        onBlur="checkcnicAvailability()" style="margin-bottom:2px !important" />

                    <span id="cnic-availability-status" style="font-size:14px;margin-bottom:-5px !important"></span>
                </div>


    <!-- check if the above written contact1 already exists or not -->
    <script>
    function checkcnicAvailability() 
    {
        var studentcnic = $("#scnic").val();

        jQuery.ajax(
        {
            url: "ajax/check-cnic-availability.php",
            data:{
                studentcnic : studentcnic
            },
            type: "POST",
            success:function(data) 
            { 
                $("#cnic-availability-status").html(data);
            
            },
            error:function (){}
        });
    }
    </script>	




                <div class="form-group">
                    <label for="title">Father / Gaurdian Name : </label>
                    <input type="text" value="" name="FGname" class="form-control" id="FGname"
                        placeholder="Enter Father / Gaurdian Name" required 
                        onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
						&& event.charCode < 123) || (event.charCode == 32)"/>
                </div>




                <div class="form-group">
                    <label for="title">Father / Gaurdian Cnic : </label>
                    <input type="text" value="" name="FGcnic" class="form-control" id="fcnic" maxlength="15"
                        placeholder="Enter CNIC i.e 37584-6885986-1 " required />
                </div>




                <div class="form-group">
                    <label for="title">Father / Gaurdian Contact No : </label>
                    <input type="text" value="" name="FGcontact" class="form-control" id="FGcontact"
                        placeholder="Enter Father / Gaurdian Contact No" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>




                <div class="form-group">
                    <label for="title">Date of Birth : </label>
                    <input type="date" value="" name="DOB" class="form-control" id="DOB"
                        placeholder="Select Date of Birth" required />
                </div>




                <div class="form-group">
                    <label for="title">Residential Address :</label>
                    <input type="text" value="" name="address" class="form-control" id="address"
                        placeholder="Enter Resedential Address" required />
                </div>




                <div class="form-group">
                    <label for="sgender" >Select Gender</label>
                    <select class="form-control" name="sgender" id="sgender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                    </select>
                </div>




                <div class="form-group">
                    <label for="sblood" >Select Blood Group</label>
                    <select class="form-control" name="sblood" id="sblood" required>
                    <option value="">Select Blood Group</option>
                    <option value="A+" >A+</option>
                    <option value="A-" >A-</option>
                    <option value="B+" > B+</option>
                    <option value="B-" >B-</option>
                    <option value="AB+" >AB+</option>
                    <option value="AB-" >AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-" >O-</option>
                    </select>
                </div>




                <div class="form-group">
                    <label for="sclass" >Select Class</label>
                    <select class="form-control" name="sclass" id="sclass" required>
                    <option value="">Select Class</option>        

                    <?php

                        $query = "select * from class";
                        $result = mysqli_query($con, $query);

                        while($row = mysqli_fetch_array($result))
                        {
                    ?>
                                
                        <option value="<?php echo $row['class_id'] ?>" >
                            <?php echo ucfirst($row['class_name']); ?>
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
                        <option value="section A" >Section A</option>
                        <option value="section B" >Section B</option>
                        <option value="section B" >Section C</option>
                    </select>
                </div>




                <div class="form-group">
                    <label for="ssection" >Fee Type</label>
                    <select class="form-control" name="feeType" id="feeType" required onBlur="displayFeeCharges()">
                        <option value="">Select Fee Type</option>
                        <option value="standard" >Standard</option>
                        <option value="scholarship" >Scholarship</option>
                    </select>
                </div>


                <!-- show data from ajax file -->
                <div id="show-fee-charges"></div>    


                <div class="form-group mt-4">
                    <label for="file">Upload Student Image :</label> <br>
                    <input type="file" name="file" class="form-check-input" id="file" style="margin-left: 0.05em;"/>
                </div>



                <input type="submit" value="Submit" name="submit" class="btn btn-info " id="submit" required/>


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


//show fee charges

    $(document).ready(function(){

        $('#feeType').on('change', function() {

            var feetype = $("#feeType").val();
            var studentClass = $("#sclass").val(); 

            // $("#loaderIcon").show();
            jQuery.ajax(
            {
                url: "ajax/admin-check-add-student-fee-charges.php",
                data:{
                    feetype:feetype,
                    studentClass:studentClass
                },
                type: "POST",
                success:function(data) 
                { 
                    $("#show-fee-charges").html(data);
                },
                error:function (){}
            });

        });




        $('#scnic').keydown(function(){

        //allow  backspace, tab, ctrl+A, escape, carriage return
        if (event.keyCode == 8 || event.keyCode == 9 
            || event.keyCode == 27 || event.keyCode == 13 
            || (event.keyCode == 65 && event.ctrlKey === true) )
                return;
            if((event.keyCode < 48 || event.keyCode > 57))
            event.preventDefault();

            var length = $(this).val().length; 
                        
            if(length == 5 || length == 13)
            $(this).val($(this).val()+'-');

        });



        $('#fcnic').keydown(function(){

        //allow  backspace, tab, ctrl+A, escape, carriage return
        if (event.keyCode == 8 || event.keyCode == 9 
            || event.keyCode == 27 || event.keyCode == 13 
            || (event.keyCode == 65 && event.ctrlKey === true) )
                return;
            if((event.keyCode < 48 || event.keyCode > 57))
            event.preventDefault();

            var length = $(this).val().length; 
                        
            if(length == 5 || length == 13)
            $(this).val($(this).val()+'-');

        });



    });

</script>            
