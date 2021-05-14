<?php

include('includes/header.php');

if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from staff_voucher where st_v_id = '$editId'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_array($result);
        
        $view_issue_date = date('Y-m-d', $row['issue_date']);
    }
}


if(isset($_POST['submit']))
{

    $issuedate = $_POST['issuedate'];
    $issuedate = strtotime($issuedate);
 
    $staffMonthlySalary = $_POST['staffmonthlysalary'];

    $query1 = "update staff_voucher set issue_date = '$issuedate', monthly_salary = '$staffMonthlySalary' where st_v_id = '$editId' ";    

    $result1 = mysqli_query($con, $query1);

    if($result1)
    {
        $msg="Staff Voucher Updated Successfully ";  
        $_SESSION['successMsg'] = $msg;
        header('location:accountant-view-edit-staff-pay-voucher.php');
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


<div class="row pt-3 ">

<!-- Page Heading -->
<!-- <div class="col-md-12 mt-lg-4 mt-5 mb-1">     
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-3 text-gray-800">Add Student Record</h1>
    </div>
</div> -->

      <!-- column -->
      <!-- <div class="offset-md-2 col-md-8 pt-5"> -->
      <div class="form-card-container pt-5 pb-5" >
                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Edit Staff Pay Voucher</h4>
                                <h5 class="card-subtitle">Edit Staff Member Pay Details</h5>
                            </div>
                        </div> 
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="row profile-details  pb-4 pt-3">

                
                <div class="col-md-12 mb-2 ">
                    <span> Member CNIC : </span> <?php echo $row['cnic']; ?> 
                </div>

                <div class="col-md-12 mb-2">
                    <span> Member Name : </span> <?php echo ucfirst($row['name']); ?> 
                </div>


            </div> 

            <div class="form-group">
                <label for="title">Issue Date : </label>
                <input  type="date" value="<?php echo $view_issue_date; ?>" 
                        name="issuedate" class="form-control" id="issuedate"
                        placeholder="Issue Date" required />
            </div>

             <div class="form-group">
                <label for="title">Staff Monthly Salary (R<small>s</small>) :</label>
                <input type="number" value="<?php echo $row['monthly_salary'] ?>" name="staffmonthlysalary" class="form-control" id="staffmonthlysalary"
                    placeholder="Enter Staff Monthly Salary" />
            </div>


            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="up-btn" style="margin-top: 20px !important;" />

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

