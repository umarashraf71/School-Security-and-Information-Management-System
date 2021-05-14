<?php

include('includes/header.php');

?>  


<title> Admin | Add Student Fingerprint </title>


<?php

if(isset($_GET['id']))
{

    $s_id = $_GET['id'];

}

if(isset($_POST['submit']))
{

    $fingerprint = $_POST['fingerprint'];
    
    $query = "update student set fingerprint_code = '$fingerprint' where s_id = $s_id ";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $msg="Student details and fingerprint added Successfully";
        $_SESSION['successMsg1'] = $msg;  
        header('location:admin-view-edit-student-record.php');
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
      <div class="form-card-container pt-5" >


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


                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Add Student Record</h4>
                                <h5 class="card-subtitle">Add Student Fingerprint</h5>
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

// include('includes/footer.php');

?>	


<script>
        setTimeout(function()
			{
				$('#message').fadeOut('fast');
			}, 2500); // <-- time in milliseconds
	</script>