<?php

include('includes/header.php');

if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from staff where st_id = '$editId'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_array($result);
    }
}



if(isset($_POST['submit']))
{
    $monthlysalary = trim($_POST['monthlysalary']); 

    $query1 = "update staff set monthly_salary = '$monthlysalary' where st_id = '$editId' " ;
    $result1 = mysqli_query($con, $query1);

    if($result1)
    {
        $msg="Staff Pay Record Updated Successfully ";  
        $_SESSION['successMsg'] = $msg;
        header('location:accountant-view-manage-staff-pay-record.php');
    }

}
?>  

<title> Accountant | Edit Staff Pay Record </title>
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
      <div class="form-card-container pt-3 pb-3" >
                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Edit Staff Pay Record</h4>
                                <h5 class="card-subtitle">Edit Staf Pay Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="row profile-details  pb-4 pt-3">

                
                <div class="col-md-12 mb-2 ">
                    <span> Member CNIC : </span> <?php echo ucfirst($row['cnic']); ?> 
                </div> 

                <div class="col-md-12 mb-2">
                    <span> Member Name : </span> <?php echo ucfirst($row['name']); ?>  
                </div>

                <div class="col-md-12 mb-2 ">
                    <span> Contact No : </span> <?php echo $row['contact']; ?> 
                </div>

                <div class="col-md-12 mb-2">
                    <span> Type : </span> <?php echo ucfirst($row['type']); ?>  
                </div>

            </div> 



             <div class="form-group">
                <label for="title">Member Monthly Salary (R<small>s</small>) :</label>
                <input type="number" value="<?php echo $row['monthly_salary']; ?>" name="monthlysalary" class="form-control" id="monthlysalary"
                    placeholder="Enter Staff Monthly Salary" required/>
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

