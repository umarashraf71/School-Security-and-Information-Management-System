<?php

include('includes/header.php');

if(isset($_POST['submit']))
{
    $expensename = $_POST['expensename'];
    $expensetype = $_POST['expensetype'];
    $expenseamount = $_POST['expenseamount'];

    $today = date("m/d/y");
    $unixDate = strtotime($today);


    $query = "insert into expense (name, type, amount, date) values ('$expensename', '$expensetype', '$expenseamount', '$unixDate')";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $msg="Expense Added Successfully ";  
        $_SESSION['successMsg'] = $msg;
        header('location:accountant-view-edit-expenses.php');
    }

}


?>  

<title>Accountant | Add Expenses</title>

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
      <div class="form-card-container pt-3 pb-3" >
                <div class="card form-card">
                    <div class="card-body student-card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Add Expenses</h4>
                                <h5 class="card-subtitle">Add Expenses detail</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">



            <div class="form-group">
                <label for="title">Expense Name : </label>
                <input type="text" value="" name="expensename" class="form-control" id="expensename"
                    placeholder="Enter Expense Name" required />
            </div>


            <div class="form-group">
                <label for="title">Expense Type : </label>
                <input type="text" value="" name="expensetype" class="form-control" id="expensetype"
                    placeholder="Enter Expense Type" required />
            </div>


            <div class="form-group">
                <label for="title">Expense Amount : </label>
                <input type="number" value="" name="expenseamount" class="form-control" id="expenseamount"
                    placeholder="Enter Expense Amount" required />
            </div>


            <input type="submit" value="Submit" class="btn btn-info " name="submit" id="submit" style="margin-top: 20px !important;" />

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

