<?php

    include('includes/header.php');

?>  

<title>Accountant | Dashboard</title>

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
            <h1 class="page-heading mt-5 mb-4 pl-1">Accountant Dashboard</h1>
            <!-- <h3 class="h3 mt-3">Section A</h3> -->
        </div>
    </div>


    <div class="col-md-12">
     <div class="row">
     
     
    <div class="col-sm-4">  
        <div class="card zoom">
        <a href="accountant-view-manage-student-fee-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/students-group.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="accountant-view-manage-student-fee-record.php"> Students Fee Record</a></h3>
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
        <a href="accountant-view-manage-teacher-pay-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/teachers-group.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="accountant-view-manage-teacher-pay-record.php"> Teachers Pay Record </a> </h3>
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
        <a href="accountant-view-manage-staff-pay-record.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/staff.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="accountant-view-manage-staff-pay-record.php"> Staff Pay Record </a> </h3>
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
        <div class="card zoom ">
        <a href="accountant-add-expenses.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/expenses.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="accountant-add-expenses.php"> Manage Expenses </a> </h3>
                <div class="mb-1">

                <?php
                
                $query4 = "select * from expense";
                $result4 = mysqli_query($con, $query4);

                if($result4)
                {
                    $count4 = mysqli_num_rows($result4);
                }
            
            ?>
                    <span class="text-primary text-uppercase">Total Expenses ( <?php echo $count4; ?> )</span>
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

