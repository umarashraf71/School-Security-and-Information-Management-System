<?php

include('includes/header.php');

?>  

<title> Admin | Add Visitor Record </title>


<?php


if(isset($_POST['submit']))
{

    $visitorName = $_POST['visitorname'];
    $visitorContact = $_POST['visitorcontact'];
    $visitorAddress = $_POST['address'];
    $visitorGender = $_POST['visitorgender'];
    
    //GETTING CNIC WITHOUT DASHES
    $visitorCnic = $_POST['cnic'];
    $visitorCnic = preg_replace('/[^0-9]/', '', $visitorCnic);

    //getting hiring date in UNIX TIMESTAMP
    $today = date("m/d/y");
    $todayUnixDate = strtotime($today);


    $query = "insert into visitor (cnic, name, contact, address, gender, visiting_date) values ('$visitorCnic', '$visitorName', '$visitorContact', '$visitorAddress', '$visitorGender', '$todayUnixDate') ";
    
    $result = mysqli_query($con, $query);

    if($result){ 

        $msg="Visitor ". $visitorName . " details added Successfully !";
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
                                <h4 class="card-title">Add Visitor Record</h4>
                                <h5 class="card-subtitle">Fill in the Visitor Form</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">

            <div class="form-group">
                <label for="title">Visitor CNIC : </label>
                <input type="text" value="" name="cnic" class="form-control" id="cnic"
                    placeholder="Enter CNIC i.e 35603-2006787-1" maxlength="15" required 
                    onBlur="checkcnicAvailability()" style="margin-bottom:2px !important" />

                    <span id="cnic-availability-status" style="font-size:14px;margin-bottom:-5px !important"></span>
                </div>


    <!-- check if the above written contact1 already exists or not -->
    <script>
    function checkcnicAvailability() 
    {
        var visitorcnic = $("#cnic").val();

        jQuery.ajax(
        {
            url: "ajax/check-cnic-availability.php",
            data:{
                visitorcnic : visitorcnic
            },
            type: "POST",
            success:function(data) 
            { 
                $("#cnic-availability-status").html(data);
            
            },
            error:function (){}
        });
    }
    </script>
 
            <div class="form-group">
                <label for="title">Visitor Name : </label>
                <input type="text" value="" name="visitorname" class="form-control" id="visitorname"
                    placeholder="Enter Visitor Name" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
					&& event.charCode < 123) || (event.charCode == 32)" />
            </div>


            <div class="form-group">
                <label for="title">Visitor Contact No : </label>
                <input type="text" value="" name="visitorcontact" class="form-control" id="visitorcontact"
                    placeholder="Enter Visitor Contact No" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
            <label for="visitorgender" >Select Gender</label>
                <select class="form-control" name="visitorgender" id="visitorgender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <div class="form-group"> 
                <label for="title">Residential Address :</label>
                <input type="text" value="" name="address" class="form-control" id="address"
                    placeholder="Enter Resedential Address" required />
            </div>

             <!-- get Visitingss date in the database with current timestamp -->

            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="submit" style="margin-top:20px !important" />
        
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

    $('#cnic').keydown(function(){

    //allow  backspace, tab, ctrl+A, escape, carriage return
    if (event.keyCode == 8 || event.keyCode == 9 
        || event.keyCode == 27 || event.keyCode == 13 
        || (event.keyCode == 65 && event.ctrlKey === true) )
            return;
        if((event.keyCode < 48 || event.keyCode > 57))
        event.preventDefault();

        var length = $(this).val().length; 
                    
        if(length == 5 || length == 13)
        $(this).val($(this).val()+'-');

    });

</script> 

