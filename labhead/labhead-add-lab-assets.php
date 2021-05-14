<?php

include('includes/header.php');

if(isset($_POST['submit']))
{

    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $today = date("m/d/y");
    $todayUnixDate = strtotime($today);

    $query = "insert into lab (name, quantity, price, description, date) values ('$name', '$quantity', '$price', '$description', '$todayUnixDate')";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $msg="Lab Asset Added Successfully ";  
        $_SESSION['successMsg'] = $msg;
        header('location:labhead-view-edit-lab-assets.php'); 
    }

}


?>  

<title>Labhead | Add Lab Assets</title>

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
      <div class="form-card-container pt-2 pb-3" >
                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Add Lab Asset </h4>
                                <h5 class="card-subtitle">Fill in the details of any lab asset or material</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="form-group"> 
                <label for="title">Asset / Material Name : </label>
                <input type="text" value="" name="name" class="form-control" id="assetmaterialname"
                    placeholder="Enter Asset or Material Name" required 
                    />
            </div>

            <div class="form-group">
                <label for="title">Asset / Material Quantity : </label>
                <input type="text" value="" name="quantity" class="form-control" id="assetmaterialquantity"
                    placeholder="Enter Asset or Material Quantity" required 
                     />
            </div>

            <div class="form-group">
                <label for="title">Asset / Material Price (Rs) :</label>
                <input type="text" value="" name="price" class="form-control" id="price"
                    placeholder="Enter Asset or Material Price" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Asset / Material Description : </label>
                <textarea rows="4" name="description" class="form-control" id="description" >Enter Asset or Material Description</textarea>
            </div>


            <input type="submit" value="Submit" name="submit" class="btn btn-info " id="up-btn"  style="margin-top:20px !important" />
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

