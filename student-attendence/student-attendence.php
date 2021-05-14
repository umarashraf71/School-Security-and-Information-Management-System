<?php

    include('includes/header.php');


    //getting current date in UNIX TIMESTAMP
    $today = date("m/d/y");
    $todayUnixDate = strtotime($today);


    //getting class and section and fetching all student in that particular class and section
    if(isset($_GET['class']) && isset($_GET['section']) )
    {
        $class_id = $_GET['class'];
        $section = $_GET['section'];

        $query0 = "select * from class where class_id = '$class_id'";
        $result0 = mysqli_query($con, $query0);
        $row0 = mysqli_fetch_array($result0);

        $query = "select * from student where class_id = '$class_id' and section = '$section'";
        $result = mysqli_query($con, $query);

    }



    if(isset($_POST['submit']))
    {
        //getting input of fingerprints
        $fingerprint = $_POST['fingerprint'];

        //$array = mysqli_fetch_array($result);


        //looping through all the student in student table and getting registered fingerprints
        while($row = mysqli_fetch_array($result))
        {

            $check_s_id = $row['s_id'];
            $check_class_id = $row['class_id'];
            $check_section = $row['section'];
            $check_roll_no = $row['roll_no'];
            $check_name = $row['name'];

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

            //if entered fingerprints match with the stored fingerprints in the student database
            if($flag == 1)
            {

                //checking if the student attendence is already marked for the current date
                $query1 = "select * from student_attendence where fingerprint_code = '$fingerprint' and date = '$todayUnixDate' ";
                $result1 = mysqli_query($con, $query1);

                if($result1)
                {
                    $row1 = mysqli_num_rows($result1);
                }

                //if student attendence is already present for the current date
                if($row1 > 0)
                {
                    $msg = "This Student Attendence has already been marked for Today !";
                    $_SESSION['deleteMsg'] = $msg;
                    header("refresh: 2; url=student-attendence.php?class=" . $class_id . "&section=" . $section ."");
                    
                }
                //if student attendence is not marked then mark student attendence for current date
                if($row1 == 0)
                {

                    $query2 = "insert into student_attendence (s_id, class_id, section, roll_no, name, status, fingerprint_code, date) values ('$check_s_id', '$check_class_id', '$check_section', '$check_roll_no', '$check_name', 'present', '$checkfingerprint', '$todayUnixDate')";
                    $result2 = mysqli_query($con, $query2);

                    if($result2)
                    {
                        $msg="Student ". ucfirst($check_name) . " attendence marked Successfully";
                        $_SESSION['successMsg'] = $msg;
                        header("refresh: 2; url=student-attendence.php?class=" . $class_id . "&section=" . $section ."");
                        
                    }

                }

                
            }

            //if entered fingerprints dont match with the stored fingerprints in the student database
            if($flag == 0)
            {
                $msg = "No Student exist with these Fingerprints !";
                $_SESSION['deleteMsg'] = $msg;
                header("refresh: 2; url=student-attendence.php?class=" . $class_id . "&section=" . $section ."");
                
            }

    }

    

//marking absent for students who didnt appear for the the attendence
    if(isset($_POST['submitattendence']))
    {

        $query4 = "select * from student where class_id = '$class_id' and section = '$section'";
        $result4 = mysqli_query($con, $query4);
        //$row4 = mysqli_fetch_array($result4);

        $query3 = "select * from student_attendence where class_id = '$class_id' and section = '$section' and date = '$todayUnixDate'";
        $result3 = mysqli_query($con, $query3);
        //$row3 = mysqli_fetch_assoc($result3);

        if($result3)
        {
            $count = mysqli_num_rows($result3);
        }

        if($count == 0 )
        {
            $msg = "Cant Submit Empty Attendence !";
            $_SESSION['deleteMsg'] = $msg;
            header("refresh: 2; url=student-attendence.php?class=" . $class_id . "&section=" . $section ."");
            
        }
        else
        {

            //storing results of attenddence table in the array
            while($attendenceArray = mysqli_fetch_assoc($result3))
            {
                $attendenceRow[] = $attendenceArray; 
            }

            //storing results of student table in the array
            while($studentArray = mysqli_fetch_assoc($result4))
            {
                $studentRow[] = $studentArray; 
            }


            //looping through all the students in particular class and section
            for($i = 0; $i < count($studentRow); $i++) 
            {
                $s_id = $studentRow[$i]['s_id'];
                $s_class_id = $studentRow[$i]['class_id'];
                $s_section = $studentRow[$i]['section'];
                $s_roll_no = $studentRow[$i]['roll_no'];
                $s_name = $studentRow[$i]['name'];
                $s_fingerprint = $studentRow[$i]['fingerprint_code'];

                // echo $s_id . " " . $s_class_id . " " . $s_section . " " . $s_roll_no . " " . $s_name . " " . $s_fingerprint . "/<br>";
            
                // for($j =0; $j < count($attendenceRow); $j++)
                // {

                //     //echo $attendenceRow[$j]['s_id'] . "<br>";
                //     $sa_id = $attendenceRow[$j]['s_id'];
                // }
                
                //searching for the student id in the attendence array for todays date
                $flag1 = array_search($s_id, array_column($attendenceRow, 's_id'));

                //if student id is not present then we add those id in the attendence table with absent status
                if ($flag1 === false) 
                {   
                    $query5 = "insert into student_attendence (s_id, class_id, section, roll_no, name, status, fingerprint_code, date) values ('$s_id', '$s_class_id', '$s_section', '$s_roll_no', '$s_name', 'absent', '$s_fingerprint', '$todayUnixDate')";
                    $result5 = mysqli_query($con, $query5);
                }
                
            }    

                $msg="Class ". $row0['class_name'] . " ". ucfirst($section) ." Attendence for Today has been Submitted Successfully !";
                $_SESSION['successMsg'] = $msg;
                header("refresh: 2; url=class-section-form.php");
    
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
            <h1 class="page-heading mt-4 pt-1 mb-0 pl-1">Class : <?php echo $row0['class_name']; ?></h1>
            <h1 class="page-subheading mt-0 pt-1 mb-0 pl-1"><?php echo ucfirst($section); ?></h1>
            <!-- <h3 class="h3 mt-3">Section A</h3> -->
        </div>
        <div class="col-md-6 col-xs-12" style="padding-top:37px !important; padding-right:17px !important">
        <form action="" method="POST" enctype="multipart/form-data" class="float-right" >
        
            <input  onclick="return confirm('Are you Sure Attendence of all Students has been Marked ?')" 
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
                        <h4 class="card-title">Student Attendence</h4>
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
