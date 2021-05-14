<?php

include('includes/header.php');


if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from student_voucher where s_v_id = '$editId'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_array($result);
        
        $view_issue_date = date('Y-m-d', $row['issue_date']);
        $view_due_date = date('Y-m-d', $row['due_date']);
    }
}

if(isset($_POST['submit']))
{

    $issuedate = $_POST['issuedate'];
    $issuedate = strtotime($issuedate);

    $duedate = $_POST['duedate'];
    $duedate = strtotime($duedate);

    $admission_fee = trim($_POST['admissionfee']);
    $bise_fee = trim($_POST['bisefee']);
    $annual_test_fee = trim($_POST['annualtestfee']);
    $monthly_test_fee = trim($_POST['monthlytestfee']);
    $monthly_tution_fee = trim($_POST['monthlytutionfee']);
    $miscellaneous_fee = trim($_POST['miscellaneousfee']);
    $fine_charges = trim($_POST['finecharges']);


    $total_fee = $admission_fee + $bise_fee + $annual_test_fee + $monthly_test_fee + $monthly_tution_fee + $fine_charges + $miscellaneous_fee; 

    $query1 = "update student_voucher set issue_date = '$issuedate', due_date = '$duedate', admission_fee = '$admission_fee', bise_fee = '$bise_fee', annual_test_fee = '$annual_test_fee', monthly_test_fee = '$monthly_test_fee', miscellaneous_fee = '$miscellaneous_fee', fine_charges = '$fine_charges', monthly_tution_fee = '$monthly_tution_fee', total_fee = '$total_fee' where s_v_id = '$editId' ";    

    $result1 = mysqli_query($con, $query1);

    if($result1)
    {
        $msg="Student Voucher Updated Successfully ";  
        $_SESSION['successMsg'] = $msg;
        header('location:accountant-view-edit-student-voucher.php');
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
                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Edit Student Voucher</h4>
                                <h5 class="card-subtitle">Edit Student Voucher Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="row profile-details  pb-4 pt-3">

                
            <div class="col-md-12 mb-2 ">
                <span> Student Name : </span> <?php echo ucfirst($row['name']); ?> 
            </div>

            <div class="col-md-12 mb-2">
                <span> Roll No : </span> <?php echo $row['roll_no']; ?> 
            </div>

            <div class="col-md-12 mb-2 ">
                <span> Class : </span> 
                <?php  
                
                $query0 = "select * from class where class_id = " . $row['class'] ."";
                $result0 = mysqli_query($con,$query0);
                $row0 = mysqli_fetch_array($result0);

                echo $row0['class_name'];

                ?>
            </div>

            <div class="col-md-12 mb-2">
                <span> Section : </span> <?php echo ucfirst($row['section']); ?> 
            </div> 

            <div class="col-md-12 mb-2">
                <span> Fee Type : </span> <?php echo ucfirst($row['fee_type']); ?>
            </div>

            <div class="col-md-12 mb-2">
                <span> Status : </span> <?php echo ucfirst($row['status']); ?>
            </div>

            </div>


<?php  

        if($row['issue_date'] == "" || $row['issue_date'] == null)
        {
?>
            <div class="form-group">
                <label for="title">Issue Date : </label>
                <input  type="date" value="" 
                        name="issuedate" class="form-control" id="issuedate"
                        placeholder="Issue Date" required />
            </div>
<?php

        }
        else
        {
?>
            <div class="form-group">
                <label for="title">Issue Date : </label>
                <input  type="date" value="<?php echo $view_issue_date; ?>" 
                        name="issuedate" class="form-control" id="issuedate"
                        placeholder="Issue Date" required />
            </div>
<?php
        }

?> 


<?php  

        if($row['due_date'] == "" || $row['due_date'] == null)
        {
?>
            <div class="form-group">
                <label for="title">Due Date : </label>
                <input  type="date" value="" 
                        name="duedate" class="form-control" id="duedate"
                        placeholder="Due Date" required />
            </div>
<?php

        }
        else
        {
?>
            <div class="form-group">
                <label for="title">Due Date : </label>
                <input  type="date" value="<?php echo $view_due_date; ?>" 
                        name="duedate" class="form-control" id="duedate"
                        placeholder="Due Date" required />
            </div>
<?php
        }

?>



            <!-- <div class="form-group">
                <label for="ssection" >Fee Type</label>
                <select class="form-control" name="feeType" id="feeType" required>
                    <option>Standard</option>
                    <option>Scholarship</option>
                </select>
            </div> -->

            <div class="form-group">
                <label for="title">Admission Fee (R<small>s</small>) : </label>
                <input type="text" value="<?php echo $row['admission_fee']; ?>" name="admissionfee" class="form-control" id="admissionfee"
                    placeholder="Enter Class Admission Fee" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">BISE Fee (R<small>s</small>) : </label>
                <input type="text" value="<?php echo $row['bise_fee']; ?>" name="bisefee" class="form-control" id="bisefee"
                    placeholder="Enter BISE Fee" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Annual Test Fee (R<small>s</small>) : </label>
                <input type="text" value="<?php echo $row['annual_test_fee']; ?>" name="annualtestfee" class="form-control" id="annualtestfee"
                    placeholder="Enter Class Annual Test Fee" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Monthly Test Fee (R<small>s</small>) : </label>
                <input type="text" value="<?php echo $row['monthly_test_fee']; ?>" name="monthlytestfee" class="form-control" id="monthlytestfee"
                    placeholder="Enter Class Monthly Test Fee" required  
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Monthly Tution Fee (R<small>s</small>) : </label>
                <input type="text" value="<?php echo $row['monthly_tution_fee']; ?>" name="monthlytutionfee" class="form-control" id="monthlytutionfee"
                    placeholder="Enter Class Monthly Tution Fee" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Miscellaneous Fee (R<small>s</small>) : </label>
                <input type="number" value="<?php echo $row['miscellaneous_fee']; ?>" name="miscellaneousfee" class="form-control" id="miscellaneousfee"
                    placeholder="Enter Miscellaneous Fee Charges ..." required />
            </div>

            <div class="form-group">
                <label for="title">Fine Charges (R<small>s</small>) : </label>
                <input type="number" value="<?php echo $row['fine_charges']; ?>" name="finecharges" class="form-control" id="finecharges"
                    placeholder="Enter Fines ..." required />
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

