
 <?php

include('includes/header.php');

if(isset($_POST['submit']))
{
    $issuedate = $_POST['issuedate'];
    $issuedate = strtotime($issuedate);

    $duedate = $_POST['duedate'];
    $duedate = strtotime($duedate);

    $class = $_POST['class'];
    $section = $_POST['section'];

    $query1 = "select * from student where class_id = '$class' && section = '$section' ";
    $result1 = mysqli_query($con, $query1);
    $rowCount1 = mysqli_num_rows($result1);

    if($result1)
    {
        if($rowCount1 > 0)
        {

            //check if vouchers already exists for current date and due date
            $query3 = "select * from student_voucher where class = '$class' && section = '$section' && issue_date = '$issuedate' && due_date = '$duedate' ";
            $result3 = mysqli_query($con, $query3);            
    
            $rowCount3 = mysqli_num_rows($result3);
            
            if($rowCount3 > 0)
            {
                $msg = "Vouchers Already Exist For this Class and Date !";
                $_SESSION['deleteMsg'] = $msg;
                header("refresh: 2; url=accountant-create-student-voucher.php");
            }
            else
            {
                $result2;
                $total_fee;

                while($row1 = mysqli_fetch_array($result1))
                {

                    $s_id = $row1['s_id'];
                    $name = $row1['name'];
                    $class_id = $row1['class_id']; 
                    $section = $row1['section'];
                    $roll_no = $row1['roll_no'];
                    $fee_type = $row1['fee_type'];
                    $admission_fee = 0;
                    $bise_fee = 0;
                    $annual_test_fee = 0;
                    $monthly_test_fee = $row1['monthly_test_fee'];
                    $monthly_tution_fee = $row1['monthly_tution_fee'];
                    $miscellaneous_fee = 0;
                    $fine_charges = 0;
                    $status = "due";

                    $total_fee = $admission_fee + $bise_fee + $annual_test_fee + $monthly_test_fee + $monthly_tution_fee + $miscellaneous_fee + $fine_charges; 

                    $query2 = "insert into student_voucher (s_id, issue_date, due_date, status, name, class, section, roll_no, fee_type, admission_fee, bise_fee, annual_test_fee, monthly_test_fee, miscellaneous_fee, fine_charges, monthly_tution_fee, total_fee  ) values ('$s_id', '$issuedate', '$duedate', '$status', '$name', '$class_id', '$section', '$roll_no', '$fee_type', '$admission_fee', '$bise_fee', '$annual_test_fee', '$monthly_test_fee', '$miscellaneous_fee', '$fine_charges', '$monthly_tution_fee', '$total_fee'  )";
                    $result2 = mysqli_query($con, $query2);

                    $total_fee = 0;

                }

                if($result2)
                {
                    $query4 = "select * from class where class_id = '$class'";
                    $result4 = mysqli_query($con, $query4);
                    $row4 = mysqli_fetch_array($result4);

                    $msg="Vouchers Generated Successfully For the Class " . $row4['class_name'] . " and " . ucfirst($section) . " ";
                    $_SESSION['successMsg'] = $msg;
                    header("refresh: 2; url=accountant-create-student-voucher.php");
                }

            }

        }
        else
        {
            $msg = "No Students Exist in This Class and Section !";
                $_SESSION['deleteMsg'] = $msg;
                header("refresh: 2; url=accountant-create-student-voucher.php");
        }

    }

}



?>  

<title>Accountant | Create Class Fee Vouchers</title>

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
		<?php if(!empty($_SESSION['successMsg'])) { ?>

            <div class="alert alert-success 
                        text-center offset-md-3 
                        col-md-6" id = "message">
                <strong style="font-size:16px;">
                    <?php echo htmlentities($_SESSION['successMsg']);?>
                    <?php echo htmlentities($_SESSION['successMsg']="");?>
                </strong>
            </div>

        <?php } ?>

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
                                <h4 class="card-title">Create Student Fee Vouchers</h4>
                                <h5 class="card-subtitle">Fill in the Voucher Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="form-group">
                <label for="title">Select Issue Date : </label>
                <input type="date" value="" name="issuedate" class="form-control" id="issuedate"
                    placeholder="" required />
            </div>

            <div class="form-group">
                <label for="title">Select Due Date : </label>
                <input type="date" value="" name="duedate" class="form-control" id="duedate"
                    placeholder="" required />
            </div> 
 
            <div class="form-group">
                <label for="class" >Select Class</label>
                <select class="form-control" name="class" id="class" required>
                    <option value="">Select Class</option>        

                            <?php

                                $query0 = "select * from class";
                                $result0 = mysqli_query($con, $query0);

                                while($row0 = mysqli_fetch_array($result0))
                                {
                            ?>
                                        
                                <option value="<?php echo $row0['class_id'] ?>" >
                                    <?php echo ucfirst($row0['class_name']); ?>
                                </option>          

                            <?php
                            
                                }
                            
                            ?>
                </select>
            </div>

            <div class="form-group">
                <label for="ssection" >Select Section</label>
                <select class="form-control" name="section" id="section" required>
                    <option value="">Select Section</option>        

                    <option value="section A" >Section A</option>
                    <option value="section B">Section B</option>
                    <option value="section C">Section C</option>
                    </select>
                </select>
            </div>

            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="voucher-btn" style="margin-top: 20px !important;" />

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

<script>
        setTimeout(function()
			{
				$('#message').fadeOut('fast');
			}, 2500); // <-- time in milliseconds
	</script>
