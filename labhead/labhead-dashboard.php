<?php

    include('includes/header.php');

?>  


<title>Labhead | Dashboard</title>   

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
 <div class="col-md-12 mt-lg-2  mb-3">     
        <div class="">
            <h1 class="page-heading mt-5 mb-4 pl-1">Labhead Dashboard</h1>
            <!-- <h3 class="h3 mt-3">Section A</h3> -->
        </div>
    </div>


    <div class="col-md-12">
     <div class="row">
     
     
    <div class="col-sm-4">
        <div class="card zoom">
        <a href="labhead-add-lab-assets.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/add-equip.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="labhead-add-lab-assets.php"> Add Lab Asset </a></h3>
                <div class="mb-1">

                <?php
                
                $query1 = "select * from lab";
                $result1 = mysqli_query($con, $query1);

                if($result1)
                {
                    $count1 = mysqli_num_rows($result1);
                }
            
                ?>

                    <span class="text-primary text-uppercase">Total Lab Assets ( <?php echo $count1; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card zoom">
        <a href="labhead-view-edit-lab-assets.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/manage-equip.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="labhead-view-edit-lab-assets.php"> Manage Lab Assets </a> </h3>
                <div class="mb-1">

                <?php
                
                    $query2 = "select * from lab";
                    $result2 = mysqli_query($con, $query2);

                    if($result2)
                    {
                        $count2 = mysqli_num_rows($result2);
                    }
                
                ?>

                    <span class="text-primary text-uppercase">Total Lab Assets ( <?php echo $count2; ?> )</span>
                </div>
            </div>
            </a>
        </div>
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
  

</body> 

<footer class=" dashboard-footer" id="footer" >
				<div class="container-fluid ">
					<div class="row text-muted">
						<div class="col-12 text-center">
							<p class="copyrights">
								<a href="index.html" class="text-muted">&copy; Copyrights 2021 SIMS</a>
							</p> 
						</div>
					</div>
				</div>
			</footer>
			


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

   
</html>


