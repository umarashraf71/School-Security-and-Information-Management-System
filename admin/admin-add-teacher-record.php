<?php

include('includes/header.php');

?>  

<title> Admin | Add Teacher Record </title>


<?php


if(isset($_POST['submit']))
{

    $teacherName = $_POST['tname'];
    $teacherContact = $_POST['tcontact'];
    $teacherAddress = $_POST['taddress'];
    $teacherEmailAddress = $_POST['temailaddress'];
    $teacherQualification = $_POST['tqualification'];
    $teacherGender = $_POST['tgender'];
    $teacherBlood = $_POST['tblood'];
    $teacherMonthlySalary = $_POST['tmonthlysalary'];
    $teacherMedicalAllowance = $_POST['tmedicalallowance'];
    $teacherTransportAllowance = $_POST['ttransportallowance'];
    

    //GETTING CNIC WITHOUT DASHES
    $teacherCnic = $_POST['tcnic'];
    $teacherCnic = preg_replace('/[^0-9]/', '', $teacherCnic);

    //DATE OF BIRTH in UNIX TIMESTAMP
    $DOB = strtotime($_POST['DOB']);

    //getting hiring date in UNIX TIMESTAMP
    $today = date("m/d/y");
    $todayUnixDate = strtotime($today);


    //upload Image
    $file = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $path = "uploads/".$file;
    move_uploaded_file($tmp_name, $path);

    if($file === "")
    {
        $file = "user.png";
    }

    $query = "insert into teacher (cnic, name, dob, contact, address, email, qualification, gender, blood_group, image, monthly_salary, medical_allowance, transport_allowance, hiring_date) values ('$teacherCnic', '$teacherName', '$DOB', '$teacherContact', '$teacherAddress', '$teacherEmailAddress', '$teacherQualification', '$teacherGender', '$teacherBlood', '$file', '$teacherMonthlySalary', '$teacherMedicalAllowance', '$teacherTransportAllowance', '$todayUnixDate') ";
    $result = mysqli_query($con, $query);

    $teacherLastId = mysqli_insert_id($con);

    if($result){ 

        $msg="Teacher ". $teacherName . " details added Successfully";
        $_SESSION['successMsg'] = $msg;
        header('location:admin-add-teacher-fingerprint.php?id=' . $teacherLastId . '');

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
                                <h4 class="card-title">Add Teacher Record</h4>
                                <h5 class="card-subtitle">Fill in the Teacher Admission Form</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">

            <div class="form-group">
                <label for="title">Teacher CNIC : </label>
                <input type="text" value="" name="tcnic" class="form-control" id="tcnic"
                    placeholder="Enter CNIC i.e 35603-2006787-1" maxlength="15" required 
                    onBlur="checkcnicAvailability()" style="margin-bottom:2px !important" />

                    <span id="cnic-availability-status" style="font-size:14px;margin-bottom:-5px !important"></span>
                </div>


    <!-- check if the above written contact1 already exists or not -->
    <script>
    function checkcnicAvailability() 
    {
        var teachercnic = $("#tcnic").val();

        jQuery.ajax(
        {
            url: "ajax/check-cnic-availability.php",
            data:{
                teachercnic : teachercnic
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
                <label for="title">Teacher Name : </label>
                <input type="text" value="" name="tname" class="form-control" id="tname"
                    placeholder="Enter Teacher Name" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
						&& event.charCode < 123) || (event.charCode == 32)" />
            </div>

            <div class="form-group">
                <label for="title">Date of Birth : </label>
                <input type="date" value="" name="DOB" class="form-control" id="DOB"
                    placeholder="Select Date of Birth" required />
            </div>

            <div class="form-group">
                <label for="title">Teacher Contact No : </label>
                <input type="text" value="" name="tcontact" class="form-control" id="tcontact"
                    placeholder="Enter Teacher Contact No" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>


            <div class="form-group">
                <label for="title">Residential Address :</label>
                <input type="text" value="" name="taddress" class="form-control" id="taddress"
                    placeholder="Enter Resedential Address" required />
            </div>

            <div class="form-group">
                <label for="title">Email Address :</label>
                <input type="email" value="" name="temailaddress" class="form-control" id="temailaddress"
                    placeholder="Enter Email Address" required />
            </div>

            <div class="form-group">
                <label for="title">Qualification :</label>
                <input type="text" value="" name="tqualification" class="form-control" id="tqualification"
                    placeholder="Enter Teacher Qualification" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
						&& event.charCode < 123) || (event.charCode == 32)" />
            </div>


            <div class="form-group">
            <label for="tgender" >Select Gender</label>
                <select class="form-control" name="tgender" id="tgender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tblood" >Select Blood Group</label>
                <select class="form-control" name="tblood" id="tblood" required>
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


             <!-- get hiring date in the database with current timestamp -->


            <div class="form-group">
                <label for="title">Teacher Monthly Salary :</label>
                <input type="number" value="" name="tmonthlysalary" class="form-control" id="tmonthlysalary"
                    placeholder="Enter Teacher Monthly Salary" 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Teacher Medical Allowance :</label>
                <input type="number" value="0" name="tmedicalallowance" class="form-control" id="tmedicalallowance"
                    placeholder="Enter Teacher Medical Allowance"
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Teacher Transport Allowance :</label>
                <input type="number" value="0" name="ttransportallowance" class="form-control" id="ttransportallowance"
                    placeholder="Enter Teacher Transport Allowance"
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group mt-4">
                <label for="file">Upload Teacher Image :</label> <br>
                <input type="file" class="form-check-input" id="file" name="file" style="margin-left: 0.05em;"/>
            </div>
            
            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="submit" />
        
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

    $('#tcnic').keydown(function(){

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

</script> 

