<?php

include('includes/header.php');

?>  


<title> Admin | Add Staff Record </title>


<?php

if(isset($_POST['submit']))
{

    $staffName = $_POST['staffname'];
    $staffContact = $_POST['staffcontact'];
    $staffAddress = $_POST['address'];
    $staffEmailAddress = $_POST['staffemailaddress'];
    $staffType = $_POST['stafftype'];
    $staffGender = $_POST['staffgender'];
    $staffBlood = $_POST['staffblood'];
    $staffMonthlySalary = $_POST['staffmonthlysalary'];
    

    //GETTING CNIC WITHOUT DASHES
    $staffCnic = $_POST['cnic'];
    $staffCnic = preg_replace('/[^0-9]/', '', $staffCnic);

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

    if($staffType == 'admin' || $staffType == 'Admin' || $staffType == 'administrator' || $staffType == 'Administrator')
    {
        $msg="Cant use type as ". $staffType ." ! Enter another type";
        $_SESSION['errorMsg'] = $msg;  
    }
    else{

        $query = "insert into staff (cnic, name, dob, image, contact, email, address, gender, blood_group, type, monthly_salary, hiring_date) values ('$staffCnic', '$staffName', '$DOB', '$file', '$staffContact', '$staffEmailAddress', '$staffAddress', '$staffGender', '$staffBlood', '$staffType', '$staffMonthlySalary', '$todayUnixDate') ";
        
        $result = mysqli_query($con, $query);

        $staffLastId = mysqli_insert_id($con);

        if($result){ 

            $msg="Staff Member ". $staffName . " details added Successfully";
            $_SESSION['successMsg'] = $msg;  
            header('location:admin-add-staff-fingerprint.php?id=' . $staffLastId . '');

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

<div class="row">

        	<!-- Notify message	--> 
		<?php if(!empty($_SESSION['errorMsg'])) { ?>

            <div class="alert alert-danger 
                        text-center offset-md-3 
                        col-md-6" id = "message">
                <strong style="font-size:16px;">
                    <?php echo htmlentities($_SESSION['errorMsg']);?>
                    <?php echo htmlentities($_SESSION['errorMsg']="");?>
                </strong>
            </div>

        <?php } ?>

</div>

                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Add Staff Record</h4>
                                <h5 class="card-subtitle">Fill in the Staff Admission Form</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">

            <div class="form-group">
                <label for="title">Member CNIC : </label>
                <input type="text" value="" name="cnic" class="form-control" id="cnic"
                    placeholder="Enter CNIC i.e 35603-2006787-1" maxlength="15" required 
                    onBlur="checkcnicAvailability()" style="margin-bottom:2px !important" />

                    <span id="cnic-availability-status" style="font-size:14px;margin-bottom:-5px !important"></span>
                </div>


    <!-- check if the above written contact1 already exists or not -->
    <script>
    function checkcnicAvailability() 
    {
        var staffcnic = $("#cnic").val();

        jQuery.ajax(
        {
            url: "ajax/check-cnic-availability.php",
            data:{
                staffcnic : staffcnic
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
                <label for="title">Member Name : </label>
                <input type="text" value="" name="staffname" class="form-control" id="staffname"
                    placeholder="Enter Staff Member Name" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
						&& event.charCode < 123) || (event.charCode == 32)" />
            </div>

            <div class="form-group">
                <label for="title">Date of Birth : </label>
                <input type="date" value="" name="DOB" class="form-control" id="DOB"
                    placeholder="Select Date of Birth" required />
            </div>

            <div class="form-group">
                <label for="title">Member Contact No : </label>
                <input type="text" value="" name="staffcontact" class="form-control" id="staffcontact"
                    placeholder="Enter Contact No" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>


            <div class="form-group">
                <label for="title">Residential Address :</label>
                <input type="text" value="" name="address" class="form-control" id="address"
                    placeholder="Enter Resedential Address" required />
            </div>

            <div class="form-group">
                <label for="title">Email Address :</label>
                <input type="text" value="" name="staffemailaddress" class="form-control" id="staffemailaddress"
                    placeholder="Enter Email Address" />
            </div>


            <div class="form-group">
                <label for="title">Member Type :</label>
                <input type="text" value="" name="stafftype" class="form-control" id="stafftype"
                    placeholder="Enter Staff Member Type" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
						&& event.charCode < 123) || (event.charCode == 32)" />
            </div>


            <div class="form-group">
            <label for="staffgender" >Select Gender</label>
                <select class="form-control" name="staffgender" id="staffgender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>


            <div class="form-group">
                <label for="staffblood" >Select Blood Group</label>
                <select class="form-control" name="staffblood" id="staffblood" required>
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
                <label for="title">Staff Member Monthly Salary :</label>
                <input type="number" value="" name="staffmonthlysalary" class="form-control" id="staffmonthlysalary"
                    placeholder="Enter Staff Member Monthly Salary" 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
            </div>

            <div class="form-group mt-4">
                <label for="file">Upload Staff Member Image :</label> <br>
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

    $('#cnic').keydown(function(){

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

<script>
        setTimeout(function()
			{
				$('#message').fadeOut('fast');
			}, 2700); // <-- time in milliseconds
	</script>