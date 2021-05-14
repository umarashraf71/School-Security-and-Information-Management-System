<?php

    include('includes/header.php');


    //getting current date in UNIX TIMESTAMP
    $today = date("m/d/y");
    $todayUnixDate = strtotime($today);

 

    if(isset($_POST['submit']))
    {
        //getting input of fingerprints
        $fingerprint = $_POST['fingerprint'];


        //query for getting all the staff members from staff table
        $query = "select * from staff ";
        $result = mysqli_query($con, $query);


        //looping through all the staff members in staff table and getting registered fingerprints
        while($row = mysqli_fetch_array($result))
        {

            $check_st_id = $row['st_id'];
            $check_cnic = $row['cnic'];
            $check_name = $row['name'];
            $check_type = $row['type'];

            //fingerprints stored in student database
            $checkfingerprint = $row['fingerprint_code'];
            
            if($checkfingerprint != null && $checkfingerprint == $fingerprint)
            {
                $flag = 1;
                break;
            }
            else
            {
                $flag = 0;
            }

        }    

            //if entered fingerprints match with the stored fingerprints in the staff database
            if($flag == 1)
            {

                //checking if the staff attendence is already marked for the current date
                $query1 = "select * from staff_attendence where fingerprint_code = '$fingerprint' and date = '$todayUnixDate' ";
                $result1 = mysqli_query($con, $query1);

                if($result1)
                {
                    $row1 = mysqli_num_rows($result1);
                }

                //if staff attendence is already present for the current date
                if($row1 > 0)
                {
                    $msg = "This Staff Member Attendence has already been marked for Today !";
                    $_SESSION['deleteMsg'] = $msg;
                    header("refresh: 2; url=staff-attendence.php");                    
                }
                //if staff attendence is not marked then mark staff attendence for current date
                if($row1 == 0)
                {

                    $query2 = "insert into staff_attendence (st_id, st_cnic, name, type, status, fingerprint_code, date) values ('$check_st_id', '$check_cnic', '$check_name', '$check_type', 'present', '$checkfingerprint', '$todayUnixDate')";
                    $result2 = mysqli_query($con, $query2);

                    if($result2)
                    {
                        $msg="Staff Member ". ucfirst($check_name) . " attendence marked Successfully";
                        $_SESSION['successMsg'] = $msg;
                        header("refresh: 2; url=staff-attendence.php");
                    }

                }

                
            }

            //if entered fingerprints dont match with the stored fingerprints in the staff database
            if($flag == 0)
            {
                $msg = "No Staff Member exist with these Fingerprints !";
                $_SESSION['deleteMsg'] = $msg;
                header("refresh: 2; url=staff-attendence.php");
                
            }

    }

    

//marking absent for STAFF MEMBERS who didnt appear for the the attendence
    if(isset($_POST['submitattendence']))
    {

        $query4 = "select * from staff";
        $result4 = mysqli_query($con, $query4);


        $query3 = "select * from staff_attendence where date = '$todayUnixDate'";
        $result3 = mysqli_query($con, $query3);


        if($result3)
        {
            $count = mysqli_num_rows($result3);
        }

        if($count == 0 )
        {
            $msg = "Cant Submit Empty Attendence !";
            $_SESSION['deleteMsg'] = $msg;
            header("refresh: 2; url=staff-attendence.php");
            
        }
        else
        {

            //storing results of attenddence table in the array
            while($attendenceArray = mysqli_fetch_assoc($result3))
            {
                $attendenceRow[] = $attendenceArray; 
            }

            //storing results of teacher table in the array
            while($staffArray = mysqli_fetch_assoc($result4))
            {
                $staffRow[] = $staffArray; 
            }


            //looping through all the staff members
            for($i = 0; $i < count($staffRow); $i++) 
            {
                $st_id = $staffRow[$i]['st_id'];
                $st_cnic = $staffRow[$i]['cnic'];
                $st_name = $staffRow[$i]['name'];
                $st_type = $staffRow[$i]['type'];
                $st_fingerprint = $staffRow[$i]['fingerprint_code'];


                //searching for the staff id in the attendence array for todays date
                $flag1 = array_search($st_id, array_column($attendenceRow, 'st_id'));

                //if staff id is not present then we add those id in the attendence table with absent status
                if ($flag1 === false) 
                {   
                    $query5 = "insert into staff_attendence (st_id, st_cnic, name, type, status, fingerprint_code, date) values ('$st_id', '$st_cnic', '$st_name', '$st_type', 'absent', '$st_fingerprint', '$todayUnixDate')";
                    $result5 = mysqli_query($con, $query5);
                }
                
            }    

                $msg="Staff Attendence for Today has been Submitted Successfully !";
                $_SESSION['successMsg'] = $msg;
                header("refresh: 2; url=staff-attendence-logout.php");
    
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
 <div class="col-md-12 mt-lg-2  mb-3">
<?php //print_r($flags) ?>
    <div class="row"> 
        <div class="col-md-6 col-xs-12">
            <h1 class="page-heading mt-4 pt-1 mb-0 pl-1">Staff Attendence</h1>
            <!-- <h3 class="h3 mt-3">Section A</h3> -->
        </div>
        <div class="col-md-6 col-xs-12" style="padding-top:25px !important; padding-right:17px !important">
        <form action="" method="POST" enctype="multipart/form-data" class="float-right" >
        
            <input  onclick="return confirm('Are you Sure Attendence of all Staff Members has been Marked ?')" 
                    type="submit" value="End Attendence" name="submitattendence" style="margin-top:0px;" class="btn btn-info " id="submit" required />
        
        </form>
        <!-- <a href="" id="submitAttendence" class="btn btn-info float-right" style="margin-top:0px;">Submit Attendence </a> -->
        </div>
    </div>
</div>
 
</div>


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



                	<!-- Notify message	-->
		<?php if(!empty($_SESSION['deleteMsg'])) { ?>

            <div class="alert alert-danger 
                        text-center offset-md-3 
                        col-md-6" id = "message">
                <strong style="font-size:16px;">
                    <?php echo htmlentities($_SESSION['deleteMsg']);?>
                    <?php echo htmlentities($_SESSION['deleteMsg']="");?>
                </strong>
            </div>

        <?php } ?>

    </div>


<div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 ">     
  
        <div class="d-flex justify-content-center align-items-center form-card-container">
        <div class="card form-card " >
            <div class="card-body student-card-body ">
                <!-- title -->
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Staff Attendence</h4>
                        <h5 class="card-subtitle">Enter Fingerprint </h5> 
                    </div>
                </div>
                <!-- title -->
            </div>
                        

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">



            <div class="form-group">
                <label for="title">Enter FingerPrint Code : </label>
                <input type="text" value="" name="fingerprint" class="form-control" id="fingerprint"
                    placeholder="Enter Fingerprint Code" required
                    />
            </div>


            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="submit" required style="margin-top:20px;" />


        </form>

            </div>
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

// include('includes/footer.php');

?>	

</body>

<!-- <footer class="dashboard-footer" id="footer" >
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-12 text-center">
							<p class="copyrights">
								<a href="index.html" class="text-muted">&copy; Copyrights 2021 SIMS</a>
							</p> 
						</div>
					</div>
				</div>
			</footer>
			 -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="vendor/js/jquery/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
    <script src="vendor/js/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/js/jquery/jquery.js"></script>
   
    <script>
    
        $('#bar').click(function(){
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper, #footer').toggleClass('toggled' );
            $('.topbar-img').toggle();    
        });

        $(document).ready(function() {
            $('.sideNav').click(function() {
                $('a.active').removeClass("active");
                $(this).addClass("active");
            });
        });
		                
    </script>

    <script>
        setTimeout(function()
            {
                $('#message').fadeOut('fast');
            }, 2500); // <-- time in milliseconds
    </script>
   
</html>
