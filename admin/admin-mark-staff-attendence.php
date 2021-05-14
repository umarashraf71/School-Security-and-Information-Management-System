<?php

include('includes/header.php');
date_default_timezone_set("Asia/Karachi");

?>  


<title> Admin | Mark Staff Attendence </title>


<?php

if(isset($_POST['submit']))
{
 
    $date = $_POST['adate'];
    $unixdate = strtotime($date);

    $status = $_POST['status'];

    $cnic = $_POST['cnic'];
    $cnic = preg_replace('/[^0-9]/', '', $cnic);


    $query1 = "select * from staff where cnic = '$cnic' limit 1"; 
    $result1 = mysqli_query($con, $query1);

    if($result1)
    {
        $rowCount1 = mysqli_num_rows($result1);
    }

    //check if current member exists in the staff record
    if($rowCount1 > 0)
    {
        $row1 = mysqli_fetch_array($result1); 
        $st_id = $row1['st_id'];
        $name = $row1['name'];
        $type = $row1['type'];
        $fingerprint = $row1['fingerprint_code'];

        //check if current staff member has already marked attendence for this date in attendence table
        $query2 = "select * from staff_attendence where st_id = '$st_id' and date = '$unixdate' ";
        $result2 = mysqli_query($con, $query2);

        if($result2)
        {
            $rowCount2 = mysqli_num_rows($result2);            
        }

        if($rowCount2 > 0)
        {
            $msg = "Staff Member Attendence Already Exists For This Date !";
            $_SESSION['errorMsg'] = $msg;
            header("refresh: 2; url=admin-mark-staff-attendence.php");            
        }
        else
        {

            $query3 = "insert into staff_attendence (st_id, st_cnic, name, type, status, fingerprint_code, date) values ('$st_id', '$cnic', '$name', '$type', '$status', '$fingerprint', '$unixdate')";
            $result3 = mysqli_query($con, $query3);

            if($result3)
            {
                $msg = "Staff Member Attendence Added Successfully !";
                $_SESSION['successMsg'] = $msg; 
                header('location:admin-edit-staff-attendence.php');
            }

        }


    }
    else
    {
        $msg = "No Such Staff Member Exists in Record !";
        $_SESSION['errorMsg'] = $msg;
        header("refresh: 2; url=admin-mark-staff-attendence.php");
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
      <div class="form-card-container pt-4 pb-4" >

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
                                <h4 class="card-title">Mark Staff Attendence</h4>
                                <h5 class="card-subtitle">Fill in Staff Attendence Form</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="form-group">
                <label for="title">Attendence Date : </label>
                <input type="date" name="adate" id="adate" class="form-control" placeholder="Select Date" required>
            </div>


            <div class="form-group" >
                <label for="ssection" >Select Attendence Status</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="">Select Status</option>        

                    <option value="present" >Present</option>
                    <option value="leave" >Leave</option>
                    <option value="absent" >Absent</option>

                </select>
            </div> 


            <div class="form-group has-search" >

                <label for="cnic" >Enter Staff Member Cnic</label>
                <input type="text" class="form-control" name="cnic" id="cnic" maxlength="15" placeholder="Enter CNIC i.e 35202-4776845-1" required>
                
            </div>

            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="up-btn"  style="margin-top:20px !important;" />
        
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