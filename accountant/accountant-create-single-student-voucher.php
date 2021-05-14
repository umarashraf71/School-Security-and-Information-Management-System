<?php

include('includes/header.php');

if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from student where s_id = '$editId'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_array($result);
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


    $s_id = $row['s_id'];
    $name = $row['name'];
    $class_id = $row['class_id']; 
    $section = $row['section'];
    $roll_no = $row['roll_no'];
    $fee_type = $row['fee_type'];
    $status = "due";


    $total_fee = $admission_fee + $bise_fee + $annual_test_fee + $monthly_test_fee + $monthly_tution_fee + $fine_charges + $miscellaneous_fee; 

    $query1 = "insert into student_voucher (s_id, issue_date, due_date, status, name, class, section, roll_no, fee_type, admission_fee, bise_fee, annual_test_fee, monthly_test_fee, miscellaneous_fee, fine_charges, monthly_tution_fee, total_fee  ) values ('$s_id', '$issuedate', '$duedate', '$status', '$name', '$class_id', '$section', '$roll_no', '$fee_type', '$admission_fee', '$bise_fee', '$annual_test_fee', '$monthly_test_fee', '$miscellaneous_fee', '$fine_charges', '$monthly_tution_fee', '$total_fee'  )";
  
    $result1 = mysqli_query($con, $query1);

    if($result1)
    {
        $msg="Student Voucher Created Successfully ";  
        $_SESSION['successMsg'] = $msg;
        header('location:accountant-view-create-single-student-voucher.php');
    }

}

?>  

<title>Accountant | Create Student Voucher</title>

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
                                <h4 class="card-title">Student Fee Voucher</h4>
                                <h5 class="card-subtitle">Add Student Fee Details</h5>
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
                    
                    $query0 = "select * from class where class_id = " . $row['class_id'] ."";
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

            </div> 


            <div class="form-group">
                <label for="title">Issue Date : </label>
                <input type="date" value="" name="issuedate" class="form-control" id="issuedate"
                    placeholder="" required />
            </div>

            <div class="form-group">
                <label for="title">Due Date : </label>
                <input type="date" value="" name="duedate" class="form-control" id="duedate"
                  placeholder="" required />
            </div>


            <!-- <div class="form-group">
                <label for="ssection" >Fee Type</label>
                <select class="form-control" name="feeType" id="feeType" required>
                    <option>Standard</option>
                    <option>Scholarship</option>
                </select>
            </div> -->

            <div class="form-group">
                <label for="title">Admission Fee (R<small>s</small>) : </label>
                <input type="text" value="0" name="admissionfee" class="form-control" id="admissionfee"
                    placeholder="Enter Class Admission Fee" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">BISE Fee (R<small>s</small>) : </label>
                <input type="text" value="0" name="bisefee" class="form-control" id="bisefee"
                    placeholder="Enter BISE Fee" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Annual Test Fee (R<small>s</small>) : </label>
                <input type="text" value="0" name="annualtestfee" class="form-control" id="annualtestfee"
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
                <input type="number" value="0" name="miscellaneousfee" class="form-control" id="miscellaneousfee"
                    placeholder="Enter Miscellaneous Fee Charges ..." required />
            </div>

            <div class="form-group">
                <label for="title">Fine (R<small>s</small>) : </label>
                <input type="number" value="0" name="finecharges" class="form-control" id="finecharges"
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

