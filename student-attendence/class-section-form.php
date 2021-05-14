<?php

    include('includes/header.php');


    if(isset($_POST['submit1']))
    {
        
        $today = date("m/d/y");
        $todayUnixDate = strtotime($today);

        $class = $_POST['sclass'];
        $section = $_POST['ssection'];

        // $query = "select * from student_attendence where class_id = '$class' and section = '$section' and date = '$todayUnixDate' ";
        // $result = mysqli_query($con, $query);

        //checking if any student exists in the particular class and section
        $query1 = "select * from student where class_id = '$class' and section = '$section'";
        $result1 = mysqli_query($con, $query1);


        // if($result)
        // {
        //     $count = mysqli_num_rows($result);
        // }

        if($result1)
        {
            $count1 = mysqli_num_rows($result1);
        }

        // if the attendence for particular class and section is done for today
        // if($count > 0)
        // {
        //     $msg = "Attendence for this Class and Section has been Done for Today !";
        //     $_SESSION['deleteMsg'] = $msg;
        //     header("refresh: 2; url=class-section-form.php");
        // }

        //If there are no students in particular class and section
        if($count1 == 0)
        {
            $msg = "No Student exists in this Class and Section !";
            $_SESSION['deleteMsg'] = $msg;
            header("refresh: 2; url=class-section-form.php");
        }

        //if no attendence is marked for today and there are student in particular class and section
        if($count1 > 0)
        {
            header("location:student-attendence.php?class=" . $class . "&section=" . $section ."");
        }

    }
    
?>  

<style>
    body{
        overflow: hidden !important;
    }
</style>

<title>Student Attendence / Select Class & Section</title>

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


     <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 mt-5">     
  
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


        <div class="d-flex justify-content-center align-items-center form-card-container">

        <div class="card form-card " >
            <div class="card-body student-card-body ">
                <!-- title -->
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Student Attendence</h4>
                        <h5 class="card-subtitle">Select the Class and Section for Attendence</h5>
                    </div>
                </div>
                <!-- title -->
            </div>
                        

            <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">

                

                <div class="form-group">
                    <label for="sclass" >Select Class</label>
                    <select class="form-control" name="sclass" id="sclass" required>

                         <option value="">Select Class</option>        

                            <?php

                                $query0 = "select * from class";
                                $result0 = mysqli_query($con, $query0);

                                while($row0 = mysqli_fetch_array($result0))
                                {
                            ?>
                                        
                                <option value="<?php echo $row0['class_id'] ?>" >
                                    <?php echo ucfirst($row0['class_name']); ?>
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
                        <option value="section B">Section B</option>
                        <option value="section C">Section C</option>
                    </select>
                </div>

                <input type="submit" value="Submit" name="submit1" class="btn btn-info " id="up-btn" style="margin-top:20px;"/>

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

