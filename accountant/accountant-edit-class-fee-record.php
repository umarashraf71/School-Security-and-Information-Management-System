<?php

include('includes/header.php');

if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from class where class_id = '$editId'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_array($result);
    }
}



if(isset($_POST['submit']))
{
    $classname = lcfirst(trim($_POST['classname']));
    $admissionfee = trim($_POST['admissionfee']);
    $bisefee = trim($_POST['bisefee']);
    $annualtestfee = trim($_POST['annualtestfee']);
    $monthlytestfee = trim($_POST['monthlytestfee']);
    $monthlytutionfee = trim($_POST['monthlytutionfee']);

  
    $query1 = "update class set class_name = '$classname', monthly_fee = '$monthlytutionfee', monthly_test_fee = '$monthlytestfee', annual_test_fee = '$annualtestfee', bise_fee = '$bisefee', admission_fee = '$admissionfee' where class_id = '$editId' " ;
    $result1 = mysqli_query($con, $query1);

    if($result1)
    {
        $msg="Class With Fee Records Updated Successfully ";  
        $_SESSION['successMsg'] = $msg;
        header('location:accountant-view-edit-class-fee-records.php');
    }

}



?>  
 
<title>Accountant | Edit Class Fee Records</title> 

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
                                <h4 class="card-title">Edit Class with Fee Records</h4>
                                <h5 class="card-subtitle">Edit Class and its Fee Records</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">

            <div class="form-group">
                <label for="title">Class Name : </label>
                <input type="text" value="<?php echo $row['class_name']; ?>" name="classname" class="form-control" id="classname"
                    placeholder="Enter Class Name i.e 1" required readonly />
            </div>

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
                <input type="text" value="<?php echo $row['monthly_fee']; ?>" name="monthlytutionfee" class="form-control" id="monthlytutionfee"
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

