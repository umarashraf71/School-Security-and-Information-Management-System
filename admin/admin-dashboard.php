<?php

    include('includes/header.php');
    
?>  

<title>Admin | Dashboard</title>     


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
            <h1 class="page-heading mt-5 mb-4 pl-1">Admin Dashboard</h1>
            <!-- <h3 class="h3 mt-3">Section A</h3> -->
            <?php 
            
            if(!isset($_SESSION['username']))
            {

                echo "<h1>session username not set</h1>";
            }
             ?>
        </div>
    </div>


    <div class="col-md-12">
     <div class="row">
     
     
    <div class="col-sm-4">
        <div class="card zoom ">
        <a href="admin-add-student-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/students-group.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0">     <a href="admin-add-student-record.php"> Add Students </a> </h3>
                <div class="mb-1">

                <?php
                
                    $query1 = "select * from student";
                    $result1 = mysqli_query($con, $query1);

                    if($result1)
                    {
                        $count1 = mysqli_num_rows($result1);
                    }
                
                ?>

                    <span class="text-primary text-uppercase">Total Students ( <?php echo $count1; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card zoom">
        <a href="admin-add-teacher-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/teachers-group.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="admin-add-teacher-record.php"> Add Teachers </a> </h3>
                <div class="mb-1">
                
                <?php
                
                    $query2 = "select * from teacher";
                    $result2 = mysqli_query($con, $query2);

                    if($result2)
                    {
                        $count2 = mysqli_num_rows($result2);
                    }
                
                ?>

                    <span class="text-primary text-uppercase">Total Teachers ( <?php echo $count2; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card zoom">
        <a href="admin-add-staff-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/staff.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="admin-add-staff-record.php"> Add Staff </a> </h3>
                <div class="mb-1">

                <?php
                
                    $query3 = "select * from staff";
                    $result3 = mysqli_query($con, $query3);

                    if($result3)
                    {
                        $count3 = mysqli_num_rows($result3);
                    }
                
                ?>

                    <span class="text-primary text-uppercase">Total Staff Members ( <?php echo $count3; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card zoom">
          <a href="admin-add-visitor-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/visitor.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="admin-add-visitor-record.php"> Add Visitor </a> </h3>
                <div class="mb-1">
                
                <?php
                
                    $query4 = "select * from visitor";
                    $result4 = mysqli_query($con, $query4);

                    if($result4)
                    {
                        $count4 = mysqli_num_rows($result4);
                    }
                
                ?>

                    <span class="text-primary text-uppercase">Total Visitors ( <?php echo $count4; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card zoom">
          <a href="admin-view-edit-staff-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/accounts.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="admin-view-edit-staff-record.php"> Manage Accountant </a> </h3>
                <div class="mb-1">
                
                <?php
                
                    $query5 = "select * from staff where type = 'accountant' ";
                    $result5 = mysqli_query($con, $query5);

                    if($result5)
                    {
                        $count5 = mysqli_num_rows($result5);
                    }
                
                ?>
                    <span class="text-primary text-uppercase">Total Accountants ( <?php echo $count5; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>
                                
    <div class="col-sm-4">
        <div class="card zoom">
          <a href="admin-view-edit-staff-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/librarian.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="admin-view-edit-staff-record.php"> Manage Librarian </a> </h3>
                <div class="mb-1">
                
                <?php
                
                    $query6 = "select * from staff where type = 'librarian' ";
                    $result6 = mysqli_query($con, $query6);

                    if($result6)
                    {
                        $count6 = mysqli_num_rows($result6);
                    }
                
                ?>
                    <span class="text-primary text-uppercase">Total Librarians ( <?php echo $count6; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card zoom">
            <a href="admin-view-edit-staff-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/laboratory.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="admin-view-edit-staff-record.php"> Manage Lab Head </a> </h3>
                <div class="mb-1">
                
                <?php
                
                    $query7 = "select * from staff where type = 'labhead' ";
                    $result7 = mysqli_query($con, $query7);

                    if($result7)
                    {
                        $count7 = mysqli_num_rows($result7);
                    }
                
                ?>

                    <span class="text-primary text-uppercase">Total Lab Heads ( <?php echo $count7; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card zoom">
        <a href="">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/security-camera.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href=""> View Cctv </a> </h3>
                <div class="mb-1">
                    <span class="text-primary text-uppercase">Total Cameras ( 10 )</span>
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
  

<?php

include('includes/footer.php');

?>	

