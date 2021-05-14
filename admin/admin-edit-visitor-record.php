<?php

include('includes/header.php');


if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from visitor where v_id = '$editId'";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);

}


if(isset($_POST['submit']))
{

    $visitorName = $_POST['visitorname'];
    $visitorContact = $_POST['visitorcontact'];
    $visitorAddress = $_POST['address'];
    $visitorGender = $_POST['visitorgender'];

    $query = "update visitor set name = '$visitorName', contact = '$visitorContact', address = '$visitorAddress', gender = '$visitorGender' where v_id = '$editId' ";   

    $result = mysqli_query($con, $query);

    if($result)
    {
        $msg="Visitor ". $visitorName . " details updated Successfully !";
        $_SESSION['successMsg'] = $msg;
        header('location:admin-view-edit-visitor-record.php');
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
                                <h4 class="card-title">Edit Visitor Record</h4>
                                <h5 class="card-subtitle">Edit Visitor Information</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">

        <div class="d-flex flex-column align-items-center justify-content-center headingName mt-4 mb-5">
                <h4> <?php echo ucfirst($row['name']); ?> </h4>
                <small style="text-transform:uppercase;" >VISITOR</small>    
        </div>

        <!-- <div class="form-group">
                <label for="title">Visitor CNIC : </label>
                <input type="text" value="" name="cnic" class="form-control" id="cnic"
                    placeholder="Enter CNIC i.e 35603-2006787-1" maxlength="15" required />
            </div> -->

            <div class="form-group">
                <label for="title">Visitor Name : </label>
                <input type="text" value="<?php echo $row['name']; ?>" name="visitorname" class="form-control" id="visitorname"
                    placeholder="Enter Visitor Name" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
					&& event.charCode < 123) || (event.charCode == 32)" />
            </div>


            <div class="form-group">
                <label for="title">Visitor Contact No : </label>
                <input type="text" value="<?php echo $row['contact']; ?>" name="visitorcontact" class="form-control" id="visitorcontact"
                    placeholder="Enter Visitor Contact No" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
            <label for="visitorgender" >Select Gender</label>
                <select class="form-control" name="visitorgender" id="visitorgender" required>
              
                    <option value="">Select Gender</option>
                    
                    <option value="male" <?php if($row['gender']=="male") echo 'selected="selected"'; ?> >Male</option>
                    <option value="female" <?php if($row['gender']=="female") echo 'selected="selected"';?> >Female</option>
                    <option value="others" <?php if($row['gender']=="others") echo 'selected="selected"';?> >Others</option>
                
                </select>
            </div>

            <div class="form-group">
                <label for="title">Residential Address :</label>
                <input type="text" value="<?php echo $row['address']; ?>" name="address" class="form-control" id="address"
                    placeholder="Enter Resedential Address" required />
            </div>


            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="up-btn" style="margin-top:20px !important" />
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

