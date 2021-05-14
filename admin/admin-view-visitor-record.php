<?php

include('includes/header.php');


if(isset($_GET['id']))
{
    $v_id = $_GET['id'];

    $query = "select * from visitor where v_id = '$v_id'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_array($result);
    }
}


?>  

<title> Admin | View Visitor Record </title>

 
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
                <div class="card form-card1" style="margin-top:50px !important; margin-bottom:50px !important;">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">View Visitor</h4>
                                <h5 class="card-subtitle">View Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <div class="student-reg-form">

            <div class="d-flex align-items-center justify-content-center mb-3  mt-3">
                <!-- <img src="assets/images/user.png" class="w-25" style="border-radius:50% !important; border:2px solid #2e4157">  -->
            </div>

            <div class="d-flex flex-column align-items-center justify-content-center headingName mt-2 mb-4">
                <h4> <?php echo ucfirst($row['name']);  ?> </h4>
                <small>VISITOR</small>
            </div>
            
            <div class="row profile-details pl-5 pr-5 pb-5 pt-3">

                
                <div class="col-md-6 mb-3">
                    <span> Visiting Date : </span>
                    <?php 
                    
                    $visiting_date = date('r', $row['visiting_date']);
                    $visiting_date = substr($visiting_date,0,17);
                    echo $visiting_date;  
                
                    ?> 
                </div>

                <div class="col-md-6 mb-3 ">
                    <span> CNIC No : </span> <?php echo $row['cnic'];  ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Gender : </span> <?php echo ucfirst($row['gender']);  ?>  
                </div>
                
                <div class="col-md-6 mb-3">
                    <span> Visitor Name : </span> <?php echo ucfirst($row['name']);  ?>  
                </div>

                <div class="col-md-6 mb-3">
                    <span> Visitor Contact : </span> <?php echo $row['contact'];  ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Residential Address : </span> <?php echo ucfirst($row['address']);  ?>  
                </div>


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

