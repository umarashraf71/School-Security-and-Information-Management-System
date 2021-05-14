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

        $staffId = $row['st_id'];
        $staffCnic = $row['cnic'];
        $staffName = $row['name'];
    }
}


if(isset($_POST['submit']))
{


    $staffMonthlySalary = $_POST['staffmonthlysalary'];
    

    //DATE OF BIRTH in UNIX TIMESTAMP
    $issuedate = strtotime($_POST['issuedate']);

    // $totalamount = $teacherMonthlySalary + $teacherMedicalAllowance + $teacherTransportAllowance;

    $query2 = "select * from staff_voucher where st_id = '$staffId' and issue_date = '$issuedate' ";
    $result2 = mysqli_query($con, $query2);
    $rowCount2 = mysqli_num_rows($result2);

    if($rowCount2 > 0)
    {
        $msg="Staff Member Pay Voucher already exists for this date !";
        $_SESSION['deleteMsg'] = $msg;
        header("refresh: 2; url=accountant-create-staff-pay-voucher.php?id=$editId");
    }
    else 
    {
        // echo "<br><br><br><br><br>";
        // echo "'$staffId', '$issuedate', '$staffCnic', '$staffName', '$staffMonthlySalary'";
        $query1 = "insert into staff_voucher (st_id, issue_date, cnic, name, monthly_salary) values ('$staffId', '$issuedate', '$staffCnic', '$staffName', '$staffMonthlySalary')";
        $result1 = mysqli_query($con, $query1);

        if($result1){ 

            $msg="Staff Member Pay Voucher created Successfully";
            $_SESSION['successMsg'] = $msg;
            header('location:accountant-view-edit-staff-pay-voucher.php'); 

        }
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
      <div class="form-card-container" >

 <div class="row">

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
                                <h4 class="card-title">Staff Member Pay Voucher</h4>
                                <h5 class="card-subtitle">Add Member Pay Details</h5>
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

                <div class="col-md-12 mb-2 ">
                    <span> Contact No : </span> <?php echo $row['contact']; ?>
                </div>

                <div class="col-md-12 mb-2">
                    <span> Type : </span> <?php echo ucfirst($row['type']); ?> 
                </div>

            </div> 


            <div class="form-group">
                <label for="title">Issue Date : </label>
                <input type="date" value="" name="issuedate" class="form-control" id="issuedate"
                    placeholder="" required />
            </div>


             <div class="form-group">
                <label for="title">Member Monthly Salary (R<small>s</small>) :</label>
                <input type="number" value="<?php echo $row['monthly_salary'] ?>" name="staffmonthlysalary" class="form-control" id="teachermonthlysalary"
                    placeholder="Enter Staff Member Monthly Salary" required />
            </div>


            <input type="submit" value="Submit"  name="submit" class="btn btn-info " id="up-btn" style="margin-top: 20px !important;" />

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

