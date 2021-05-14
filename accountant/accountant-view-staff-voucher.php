<?php

include('includes/header.php');

if(isset($_GET['id']))
{
        $viewId = $_GET['id'];
        $query = "select * from staff_voucher where st_v_id = '$viewId' ";
    
        $result = mysqli_query($con, $query);

        if($result)
        {
            $row = mysqli_fetch_array($result);
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
      <div class="form-card-container pt-3 pb-3" >
                <div class="card form-card" style="width:40% !important">
                    <div class="card-body student-card-body" >
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">SIMS</h4>
                                <h5 class="card-subtitle">Pay Voucher</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">


            <div class="row profile-details  pb-4 pt-3 fee-voucher">

                <div class="col-md-12 mb-2  text-center ">
                    <h3> Daxam Estate Limited Bank  </h3> 
                    <small> DHA Phase 8 Branch, Lahore </small>
                </div>

    

                <div class="col-md-12 mb-1  pt-3 mt-4 border-top">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Account No </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                            04587651234743
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1 ">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Issue Date </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php echo date('d-m-Y' , $row['issue_date']); ?>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 mb-1 pt-3 mt-2 border-top">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> CNIC </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php echo $row['cnic']; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2 ">                    
                    <div class="row">
                        <div class="col-md-3 text-left">
                            <span> Name </span>
                        </div>
                        
                        <div class="col-md-9 text-right">
                        <?php echo ucfirst($row['name']); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1 pt-3 mt-2 border-top">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Monthly Salary </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php echo $row['monthly_salary']; ?>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 mb-2 pt-4 mt-2 border-top">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Total Amount (Rs) </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php echo $row['monthly_salary']; ?>
                        </div>
                    </div>
                </div>


            </div>






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

