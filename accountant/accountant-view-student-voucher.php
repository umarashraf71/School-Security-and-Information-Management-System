<?php

include('includes/header.php');

if(isset($_GET['id']))
{
        $viewId = $_GET['id'];
        $query = "select * from student_voucher where s_v_id = '$viewId' ";
    
        $result = mysqli_query($con, $query);

        if($result)
        {
            $row = mysqli_fetch_array($result);
        }
        
}

?>  

<title>Accountant | View Student Voucher</title>

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
                <div class="card form-card" style="width:40% !important">
                    <div class="card-body student-card-body" >
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">SIMS</h4>
                                <h5 class="card-subtitle">Fee Voucher</h5>
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

                <div class="col-md-12 mb-1  ">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Due Date </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 

                            if($row['due_date'] == "" || $row['due_date'] == null)
                            {
                                echo "None";
                            }
                            else
                            {
                                echo date('d-m-Y' , $row['due_date']); 
                            }

                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2  ">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Status </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php echo ucfirst($row['status']); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1 pt-3 mt-2 border-top">                    
                    <div class="row">
                        <div class="col-md-3 text-left">
                            <span> Name </span>
                        </div>
                        
                        <div class="col-md-9 text-right">
                        <?php echo ucfirst($row['name']); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1 ">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Class </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                            <?php 
                                        
                                $classId = $row['class'];

                                $query1 = "select * from class where class_id = '$classId'";
                                $result1 = mysqli_query($con, $query1);
                                
                                $row1 = mysqli_fetch_array($result1);
                                $className = $row1['class_name'];

                                echo ucfirst($className); 
                        
                            ?>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 mb-1 ">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Section </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php echo ucfirst($row['section']); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Roll No </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php echo ucfirst($row['roll_no']); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1 pt-3 mt-2 border-top">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Fee Type </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 
                        
                        echo ucfirst($row['fee_type']); 
                        
                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Admission Fee </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 
                        
                        if($row['admission_fee'] == "" || $row['admission_fee'] == null)
                        {
                            echo "0";        
                        }
                        else
                        {
                            echo ucfirst($row['admission_fee']); 
                        }
 
                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> BISE Fee </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 
                        
                        if($row['bise_fee'] == "" || $row['bise_fee'] == null)
                        {
                            echo "0";        
                        }
                        else
                        {
                            echo ucfirst($row['bise_fee']); 
                        }

                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Annual Test Fee </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 
                        
                        if($row['annual_test_fee'] == "" || $row['annual_test_fee'] == null)
                        {
                            echo "0";        
                        }
                        else
                        {
                            echo ucfirst($row['annual_test_fee']);
                        }

                        ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Monthly Test Fee </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 
                        
                        if($row['monthly_test_fee'] == "" || $row['monthly_test_fee'] == null)
                        {
                            echo "0";        
                        }
                        else
                        {
                            echo ucfirst($row['monthly_test_fee']);
                        }

                         ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Miscellaneous Fee </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 
                        
                            if($row['miscellaneous_fee'] == "" || $row['miscellaneous_fee'] == null)
                            {
                                echo "0";        
                            }
                            else
                            {
                                echo ucfirst($row['miscellaneous_fee']);
                            }
                        ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-1">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Fine Charges </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 
                        
                        if($row['fine_charges'] == "" || $row['fine_charges'] == null)
                        {
                            echo "0";        
                        }
                        else
                        {
                            echo ucfirst($row['fine_charges']);
                        }
                        
                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Tution Fee </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php 
                        
                        if($row['monthly_tution_fee'] == "" || $row['monthly_tution_fee'] == null)
                        {
                            echo "0";        
                        }
                        else
                        {
                            echo ucfirst($row['monthly_tution_fee']); 
                        }

                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2 pt-4 mt-2 border-top">                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span> Total Amount (Rs) </span>
                        </div>
                        
                        <div class="col-md-6 text-right">
                        <?php echo ucfirst($row['total_fee']); ?>
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

