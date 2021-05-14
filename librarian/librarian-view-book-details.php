<?php

include('includes/header.php');
 
if(isset($_GET['s_id']) && isset($_GET['b_id']) )
{
    $studentId = $_GET['s_id'];
    $bookId = $_GET['b_id'];

    $query1 = "select * from student where s_id = '$studentId'";
    $result1 = mysqli_query($con, $query1);

    $row1 = mysqli_fetch_array($result1);


    $query2 = "select * from library_issue_books where l_ib_id = '$bookId' ";
    $result2 = mysqli_query($con, $query2);

    $row2 = mysqli_fetch_array($result2);

}


if(isset($_GET['t_id']) && isset($_GET['b_id']) )
{
    $teacherId = $_GET['t_id'];
    $bookId = $_GET['b_id'];

    $query1 = "select * from teacher where t_id = '$teacherId'";
    $result1 = mysqli_query($con, $query1);

    $row1 = mysqli_fetch_array($result1);


    $query2 = "select * from library_issue_books where l_ib_id = '$bookId' ";
    $result2 = mysqli_query($con, $query2);

    $row2 = mysqli_fetch_array($result2);

}


if(isset($_GET['st_id']) && isset($_GET['b_id']) )
{
    $staffId = $_GET['st_id'];
    $bookId = $_GET['b_id'];

    $query1 = "select * from staff where st_id = '$staffId'";
    $result1 = mysqli_query($con, $query1);

    $row1 = mysqli_fetch_array($result1);


    $query2 = "select * from library_issue_books where l_ib_id = '$bookId' ";
    $result2 = mysqli_query($con, $query2);

    $row2 = mysqli_fetch_array($result2);

}


?>  

<title>Librarian | Issued Book Details</title>

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
                                <h4 class="card-title">Book Details</h4>
                                <h5 class="card-subtitle">View Book Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <div class="student-reg-form">

            <!-- <div class="d-flex align-items-center justify-content-center mb-3  mt-3">
                <img src="assets/images/user.png" class="w-25" style="border-radius:50% !important; border:2px solid #2e4157"> 
            </div> -->

            <div class="d-flex flex-column align-items-center justify-content-center headingName mt-4 mb-5">
                <h4> <?php echo $row1['name'] ?> </h4>

            <?php

                if(isset($_GET['s_id']) && isset($_GET['b_id']) )
                {
                    echo "<small>STUDENT</small>";
                }    

                if(isset($_GET['t_id']) && isset($_GET['b_id']) )
                {
                    echo "<small>TEACHER</small>";
                }    

                if(isset($_GET['st_id']) && isset($_GET['b_id']) )
                {
                    echo "<small>STAFF MEMBER</small>";
                }    

            ?>



            </div> 
            
            <div class="row profile-details pl-5 pr-5 pb-5 pt-3">

                
<?php

if(isset($_GET['s_id']) && isset($_GET['b_id']) )
{

?>
            
                <div class="col-md-6 mb-3 ">
                    <span> B-FORM No : </span> <?php echo $row1['b_form'] ?>
                </div>

                <div class="col-md-6 mb-3 ">
                    <span> Father / Gaurdian Cnic : </span> <?php echo $row1['father_cnic'] ?>
                </div>

                <div class="col-md-6 mb-3 ">
                    <span> Father Name : </span> <?php echo $row1['father_name'] ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Contact No : </span> <?php echo $row1['father_contact'] ?>
                </div>
 
                <div class="col-md-6 mb-3">
                    <span> Class : </span>
                    <?php  
                
                        $query0 = "select * from class where class_id = " . $row1['class_id'] ."";
                        $result0 = mysqli_query($con,$query0);
                        $row0 = mysqli_fetch_array($result0);

                        echo $row0['class_name'];

                ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Section : </span> <?php echo ucfirst($row1['section']) ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Roll No : </span> <?php echo $row1['roll_no'] ?>
                </div>

                <div class="col-md-12 mb-3">
                    <span> Residential Address : </span> <?php echo ucfirst($row1['address']) ?> 
                </div>

<?php 
    }
?>

<?php

if(isset($_GET['t_id']) && isset($_GET['b_id']) )
{

?>

                <div class="col-md-6 mb-3 ">
                    <span> Teacher Cnic : </span> <?php echo $row1['cnic'] ?>
                </div>

                <div class="col-md-6 mb-3 ">
                    <span> Teacher Name : </span> <?php echo ucfirst($row1['name']) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Contact No : </span> <?php echo $row1['contact'] ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Email : </span> <?php echo $row1['email'] ?>
                </div>

                <div class="col-md-12 mb-3">
                    <span> Address : </span> <?php echo ucfirst($row1['address']) ?>
                </div>

<?php 
    }
?>


<?php

if(isset($_GET['st_id']) && isset($_GET['b_id']) )
{

?>

                <div class="col-md-6 mb-3 ">
                    <span> Member Cnic : </span> <?php echo $row1['cnic'] ?>
                </div>

                <div class="col-md-6 mb-3 ">
                    <span> Member Name : </span> <?php echo ucfirst($row1['name']) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Contact No : </span> <?php echo $row1['contact'] ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Email : </span> <?php echo $row1['email'] ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Type : </span> <?php echo ucfirst($row1['type']); ?>
                </div>

                <div class="col-md-12 mb-3">
                    <span> Address : </span> <?php echo ucfirst($row1['address']) ?>
                </div>

<?php 
    }
?>





<?php

    $book_no = $row2['book_no'];

    $query3 = "select * from library_books where book_no = '$book_no'";
    $result3 = mysqli_query($con, $query3);

    if($result3)
    {
        $row3 = mysqli_fetch_array($result3);
    }

?>



                <div class="col-md-12 mt-2 mb-4 border-top">
                </div>                

                <div class="col-md-6 mb-3">
                    <span> Issue Date : </span> <?php echo date('d-m-Y' , $row2['issue_date']); ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Return Date : </span> <?php echo date('d-m-Y' , $row2['return_date']); ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Book No : </span> <?php echo $row2['book_no']; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <span> Book Name : </span> <?php echo $row2['book_name']; ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Author Name : </span> <?php echo $row3['author_name']; ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Book Edition : </span> <?php echo $row3['edition']; ?> 
                </div>

                <div class="col-md-6 mb-3">
                    <span> Status : </span> <?php echo ucfirst($row2['status']); ?>
                </div>

            </div>

        </div>

 
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

