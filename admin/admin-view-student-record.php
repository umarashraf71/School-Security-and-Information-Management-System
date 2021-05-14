<?php

include('includes/header.php');


if(isset($_GET['id']))
{
    $s_id = $_GET['id'];

    $query = "select * from student where s_id = '$s_id'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_array($result);

    }
}


?>  

<title> Admin | View Student Record </title>

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
                <div class="card form-card1">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center"> 
                            <div>
                                <h4 class="card-title">View Student</h4>
                                <h5 class="card-subtitle">View Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <div class="student-reg-form">

            <div class="d-flex align-items-center justify-content-center mb-3  mt-3">
                <img src="uploads/<?php echo $row['image']; ?>" class="w-25" style="border-radius:50% !important; border:2px solid #2e4157"> 
            </div>

            <div class="d-flex flex-column align-items-center justify-content-center headingName mb-4">
                <h4> <?php echo ucfirst($row['name']);  ?> </h4>
                <small>STUDENT</small>
            </div>
            
            <div class="row profile-details pl-5 pr-5 pb-5 pt-3">

                <div class="col-md-6 mb-3">
                    <span> Roll No : </span> <?php echo $row['roll_no'];  ?>
                </div>
                
                <div class="col-md-6 mb-3 ">
                    <span> B-Form No : </span> <?php echo $row['b_form'];  ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Admission Date : </span> 
                    <?php 
                    
                        
                        $adm_date = date('r', $row['admission_date']);
                        $adm_date = substr($adm_date,0,17);
                        echo $adm_date;  
                    
                    ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> D-O-B : </span> 
                    <?php 
                    
                        
                        $dob_date = date('r', $row['dob']);
                        $dob_date = substr($dob_date,0,17);
                        echo $dob_date;  
                    
                    ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Gender : </span> <?php echo ucfirst($row['gender']);  ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Father/Gaurdian Cnic : </span> <?php echo $row['father_cnic'];  ?>
                </div>
                
                <div class="col-md-6 mb-3">
                    <span> Father/Gaurdian Name : </span> <?php echo ucfirst($row['father_name']);  ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Father/Gaurdian Contact : </span> <?php echo $row['father_contact'];  ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Residential Address : </span> <?php echo ucfirst($row['address']);  ?>
                </div>


                <div class="col-md-6 mb-3">
                    <span> Blood Group : </span> <?php echo ucfirst($row['blood_group']);  ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Class : </span>
                    <?php 
                                        
                        $classId = $row['class_id'];

                        $query1 = "select * from class where class_id = '$classId'";
                        $result1 = mysqli_query($con, $query1);
                        
                        $row1 = mysqli_fetch_array($result1);
                        $className = $row1['class_name'];

                        echo ucfirst($className); 
                    
                    ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Section : </span> <?php echo ucfirst($row['section']);  ?>  
                </div>

                <div class="col-md-6 mb-3">
                    <span> Fee Type : </span> <?php echo ucfirst($row['fee_type']);  ?>  
                </div>

                <div class="col-md-6 mb-3">
                    <span> Admission Fee (Rs) : </span> <?php echo ucfirst($row['admission_fee']);  ?>   
                </div>

                <div class="col-md-6 mb-3">
                    <span> BISE Fee (Rs) : </span> <?php echo ucfirst($row['bise_fee']);  ?>   
                </div>

                <div class="col-md-6 mb-3">
                    <span> Annual Test Fee (Rs) : </span> <?php echo ucfirst($row['annual_test_fee']);  ?>  
                </div>

                <div class="col-md-6 mb-3">
                    <span> Monthly Test Fee (Rs) : </span> <?php echo ucfirst($row['monthly_test_fee']);  ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Monthly Tution Fee (Rs) : </span> <?php echo ucfirst($row['monthly_tution_fee']);  ?>   
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

