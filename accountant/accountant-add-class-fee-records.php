<?php

include('includes/header.php');

?>  

<title>Accountant | Add Class with Fee Records</title>

 
<?php


if(isset($_POST['submit']))
{
    $classname = lcfirst(trim($_POST['classname']));
    $admissionfee = trim($_POST['admissionfee']);
    $bisefee = trim($_POST['bisefee']);
    $annualtestfee = trim($_POST['annualtestfee']);
    $monthlytestfee = trim($_POST['monthlytestfee']);
    $monthlytutionfee = trim($_POST['monthlytutionfee']);

    //getting current date in UNIX TIMESTAMP
    $today = date("m/d/y");
    $todayUnixDate = strtotime($today);

    if( $classname == '1' || 
        $classname == '2' ||
        $classname == '3' ||
        $classname == '4' ||
        $classname == '5' ||
        $classname == '6' ||
        $classname == '7' ||
        $classname == '8' ||
        $classname == '9' ||
        $classname == '10' ||
        $classname == 'playgroup' ||
        $classname == 'nursery' ||
        $classname == 'prep' )
    {

        $query1 = "select * from class where class_name = '$classname'";
        $result1 = mysqli_query($con, $query1);

        if($result1)
        {
            $rowCount1 = mysqli_num_rows($result1);
        }


        if($rowCount1 > 0)
        {
            $msg="Class Name Already Exists !";
            $_SESSION['errorMsg'] = $msg;
            header("refresh: 2; url=accountant-add-class-fee-records.php");
        }
        else
        {

            $query2 = "insert into class (class_name, monthly_fee, monthly_test_fee, annual_test_fee, bise_fee, admission_fee, date) values ('$classname', '$monthlytutionfee', '$monthlytestfee', '$annualtestfee', '$bisefee', '$admissionfee', '$todayUnixDate')";
            $result2 = mysqli_query($con, $query2);

            if($result2)
            {
                $msg="Class With Fee Records Added Successfully ";  
                $_SESSION['successMsg'] = $msg;
                header('location:accountant-view-edit-class-fee-records.php');
            }

        }

    }
    else
    {
        $msg="Entered Class Name is Invalid !";
        $_SESSION['errorMsg'] = $msg;
        header("refresh: 2; url=accountant-add-class-fee-records.php");
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
            <?php if(!empty($_SESSION['errorMsg'])) { ?>

                <div class="alert alert-danger 
                            text-center offset-md-3 
                            col-md-6" id = "message">
                    <strong style="font-size:16px;">
                        <?php echo htmlentities($_SESSION['errorMsg']);?>
                        <?php echo htmlentities($_SESSION['errorMsg']="");?>
                    </strong>
                </div>

            <?php } ?>

    </div>

                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Add Class with Fee Records</h4>
                                <h5 class="card-subtitle">Add Class and its Fee Records</h5>
                            </div>
                        </div>
                        <!-- title --> 
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="form-group">
                <label for="title">Class Name : </label>
                <input type="text" value="" name="classname" class="form-control" id="classname"
                    placeholder="Enter Class Name i.e 1" required />
            </div>

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
                <input type="text" value="0" name="monthlytestfee" class="form-control" id="monthlytestfee"
                    placeholder="Enter Class Monthly Test Fee" required  
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Monthly Tution Fee (R<small>s</small>) : </label>
                <input type="text" value="0" name="monthlytutionfee" class="form-control" id="monthlytutionfee"
                    placeholder="Enter Class Monthly Tution Fee" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <input type="submit" value="Submit" name="submit"  class="btn btn-info " id="submit" style="margin-top: 20px !important;" />

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
			}, 2700); // <-- time in milliseconds
	</script>