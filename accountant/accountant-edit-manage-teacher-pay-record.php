<?php

include('includes/header.php');

if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from teacher where t_id = '$editId'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_array($result);
    }
}



if(isset($_POST['submit']))
{
    $monthlysalary = trim($_POST['monthlysalary']); 
    $medicalallowance = trim($_POST['medicalallowance']);
    $transportallowance = trim($_POST['transportallowance']);

    $query1 = "update teacher set monthly_salary = '$monthlysalary', medical_allowance = '$medicalallowance', transport_allowance = '$transportallowance' where t_id = '$editId' " ;
    $result1 = mysqli_query($con, $query1);

    if($result1)
    {
        $msg="Teacher Pay Record Updated Successfully ";  
        $_SESSION['successMsg'] = $msg;
        header('location:accountant-view-manage-teacher-pay-record.php');
    }

}



?>  

<title>Accountant | Edit Teacher Pay Record</title>

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
                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Edit Teacher Pay Record</h4>
                                <h5 class="card-subtitle">Edit Teacher Pay Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="row profile-details  pb-4 pt-3">

                
                <div class="col-md-12 mb-2 ">
                    <span> Teacher CNIC : </span> <?php echo ucfirst($row['cnic']); ?> 
                </div> 

                <div class="col-md-12 mb-2">
                    <span> Teacher Name : </span> <?php echo ucfirst($row['name']); ?> 
                </div>

                <div class="col-md-12 mb-2 ">
                    <span> Contact No : </span> <?php echo $row['contact']; ?> 
                </div>

                <div class="col-md-12 mb-2">
                    <span> Email : </span> <?php echo $row['email']; ?>
                </div>

            </div> 



             <div class="form-group">
                <label for="title">Teacher Monthly Salary (R<small>s</small>) :</label>
                <input type="number" value="<?php echo $row['monthly_salary']; ?>" name="monthlysalary" class="form-control" id="monthlysalary"
                    placeholder="Enter Teacher Monthly Salary" />
            </div>

            <div class="form-group">
                <label for="title">Teacher Medical Allowance (R<small>s</small>) :</label>
                <input type="number" value="<?php echo $row['medical_allowance']; ?>" name="medicalallowance" class="form-control" id="medicalallowance"
                    placeholder="Enter Teacher Medical Allowance" />
            </div>

            <div class="form-group">
                <label for="title">Teacher Transport Allowance (R<small>s</small>) :</label>
                <input type="number" value="<?php echo $row['transport_allowance']; ?>" name="transportallowance" class="form-control" id="transportallowance"
                    placeholder="Enter Teacher Transport Allowance" />
            </div>

            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="submit" style="margin-top: 20px !important;" />

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

include('includes/footer.php');

?>	

