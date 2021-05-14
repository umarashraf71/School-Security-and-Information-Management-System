<?php

include('includes/header.php');


$query0 = "select * from logins where type = 'librarian'";
$result0 = mysqli_query($con, $query0);

if($result0)
{
    $row0 = mysqli_fetch_array($result0);

    $previousUsername = $row0['username'];
    $previousPassword = $row0['password'];
    $previousCPassword = $row0['password'];
}



if(isset($_POST['submit']))
{

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];


    $query = "select * from logins where username = '$username' and type != 'librarian'";
    $result = mysqli_query($con, $query);

    $count = mysqli_num_rows($result);




    if( strlen($username) < 6 )
    {
        $msg = "Username should contain at least 6 characters ";
        $_SESSION['errorMsg'] = $msg;
        header("refresh: 2; url=admin-manage-librarian-password.php");
    }

    else if( strlen($password) < 6 )
    {
        $msg = "Password should contain at least 6 characters ";
        $_SESSION['errorMsg'] = $msg;
        header("refresh: 2; url=admin-manage-librarian-password.php");
    }

    else if($count > 0)
    {
        $msg = "Username already exists !";
        $_SESSION['errorMsg'] = $msg;
        header("refresh: 2; url=admin-manage-librarian-password.php");
    }

    else if($password !== $cpassword )
    {
        $msg = "Password and confirm password do not match !";
        $_SESSION['errorMsg'] = $msg;
        header("refresh: 2; url=admin-manage-librarian-password.php");
    }


    //if($password == $cpassword && $count <= 0)
    else
    {

        $query1 = "update logins set username = '$username', password = '$password' where type = 'librarian'";
        $result1 = mysqli_query($con, $query1);

        $msg="Password and Username Updated Successfully !";
        $_SESSION['successMsg'] = $msg;
        header("refresh: 2; url=admin-manage-librarian-password.php");

    }

}



?>  


<title> Admin | Reset Librarian Username & Password  </title>

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



      <div class="d-flex justify-content-center align-items-center form-card-container">
                <div class="card form-card" style="margin-top:-20px !important;">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Librarian Reset Username & Password</h4>
                                <h5 class="card-subtitle">Change Librarian Username & Password</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


        <!-- <div class="d-flex align-items-center justify-content-center mb-3 ">
            <img src="assets/images/user.png" class="w-25" style="border-radius:50% !important; border:2px solid #2e4157"> 
        </div>

        <div class="d-flex flex-column align-items-center justify-content-center headingName mb-4">
            <h4> Imran Khan </h4>
            <small>Librarian</small>    
        </div> -->

            <div class="row">

        	<!-- Notify message	--> 
		<?php if(!empty($_SESSION['successMsg'])) { ?>

            <div class="alert alert-success 
                        text-center offset-md-1 
                        col-md-10" id = "message">
                <strong style="font-size:16px;">
                    <?php echo htmlentities($_SESSION['successMsg']);?>
                    <?php echo htmlentities($_SESSION['successMsg']="");?>
                </strong>
            </div>

        <?php } ?>


                	<!-- Notify message	-->
		<?php if(!empty($_SESSION['errorMsg'])) { ?>

            <div class="alert alert-danger 
                        text-center offset-md-1 
                        col-md-10" id = "message">
                <strong style="font-size:16px;">
                    <?php echo htmlentities($_SESSION['errorMsg']);?>
                    <?php echo htmlentities($_SESSION['errorMsg']="");?>
                </strong>
            </div>

        <?php } ?>

    </div>



            <div class="form-group">
                <label for="title">Username : </label>
                <input type="text" value="<?php echo $previousUsername; ?>" name="username" class="form-control" id="username"
                    placeholder="Enter New Username" required />
            </div>

            <div class="form-group">
                <label for="title">Password : </label>
                <input type="text" value="<?php echo $previousPassword; ?>" name="password" class="form-control" id="password"
                    placeholder="Enter New Password" required />
            </div>

            <div class="form-group">
                <label for="title">Confirm Password : </label>
                <input type="text" value="<?php echo $previousCPassword; ?>" name="confirmpassword" class="form-control" id="confirmpassword"
                    placeholder="Enter Password Again" required />
            </div>


            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="up-btn" style="margin-top:20px !important" />
        
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

//include('includes/footer.php');

?>	



</body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="vendor/js/jquery/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
    <script src="vendor/js/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/js/jquery/jquery.js"></script>
   
    <script>
    
        // $('#bar').click(function(){
        //     $(this).toggleClass('is-closed');
        //     $('#page-content-wrapper ,#sidebar-wrapper, #footer').toggleClass('toggled' );
        //     $('.topbar-img').toggleClass('logo-display');    
        // });

        // $(document).ready(function() {
        //     $('.sideNav').click(function() {
        //         $('a.active').removeClass("active");
        //         $(this).addClass("active");
        //     });
        // });

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
