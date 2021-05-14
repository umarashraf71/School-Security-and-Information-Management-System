<?php

include('includes/header.php');


if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from student where s_id = '$editId'";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);
}


if(isset($_POST['submit']))
{
    $bookno = $_POST['bookno'];
    $bookname = $_POST['bookname'];
    
    $issuedate = $_POST['issuedate'];
    $issuedate = strtotime($issuedate);

    $returndate = $_POST['returndate'];
    $returndate = strtotime($returndate);

    $status = "issued";
    $type = "student";
    $s_id = $row['s_id'];

    $query1 = "select * from library_books where book_no = '$bookno'";
    $result1 = mysqli_query($con, $query1);

    if($result1)
    {
        $rowCount1  = mysqli_num_rows($result1);
        $row1 = mysqli_fetch_array($result1);
    }
 
    if($rowCount1 > 0)
    {

        $bookid = $row1['book_id'];

        $query2 = "insert into library_issue_books (s_id, book_id, book_no, book_name, status, type, issue_date, return_date) values ('$s_id', '$bookid', '$bookno', '$bookname', '$status', '$type', '$issuedate', '$returndate')";
        $result2 = mysqli_query($con, $query2);

        if($result2)
        {
            $msg="Book Issued Successfully ";  
            $_SESSION['successMsg'] = $msg;
            header('location:librarian-view-issued-books.php');
        }

    }
    else
    {
        $msg = "Book with No " . $bookno ." dont exist !";
        $_SESSION['deleteMsg'] = $msg;
        header("refresh: 2; url=librarian-issue-to-student.php?id=$editId");
    }

}



?>  
 

 
<title>Librarian | Issue to Student</title>

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
                                <h4 class="card-title">Issue Book Form</h4>
                                <h5 class="card-subtitle">Issue Book to Student</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">



            <!-- <div class="d-flex align-items-center justify-content-center mb-3 ">
                <img src="assets/images/user.png" class="w-25" style="border-radius:50% !important; border:2px solid #2e4157">
            </div> -->
                
            <!-- <div class="d-flex flex-column align-items-center justify-content-center headingName mb-4">
                <h4> Vennesa Ferns </h4>
                <small>STUDENT</small>    
            </div> -->


             <div class="row profile-details  pb-4 pt-3">

                
                <div class="col-md-12 mb-2 ">
                    <span> Student Name : </span> <?php echo ucfirst($row['name']); ?>
                </div>

                <div class="col-md-12 mb-2">
                    <span> Roll No : </span> <?php echo $row['roll_no']; ?> 
                </div>

                <div class="col-md-12 mb-2 ">
                    <span> Class : </span>   
                    <?php  
                    
                    $query0 = "select * from class where class_id = " . $row['class_id'] ."";
                    $result0 = mysqli_query($con,$query0);
                    $row0 = mysqli_fetch_array($result0);

                    echo $row0['class_name'];

                    ?> 
                </div>

                <div class="col-md-12 mb-2">
                    <span> Section : </span> <?php echo ucfirst($row['section']); ?>
                </div>

            </div>


            <div class="form-group">
                <label for="title">Book No : </label>
                <input type="text" value="" name="bookno" class="form-control" id="bookno"
                    placeholder="Enter Book No " required  maxlength="11"
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Book Name : </label>
                <input type="text" value="" name="bookname" class="form-control" id="bookname"
                    placeholder="Enter Book Name" required />
            </div>

            <div class="form-group">
                <label for="title">Issue Date :</label>
                <input type="date" value="" name="issuedate" class="form-control" id="issuedate"
                    placeholder="" required />
            </div>

            <div class="form-group">
                <label for="title">Return Date :</label>
                <input type="date" value="" name="returndate" class="form-control" id="returndate"
                    placeholder="" required />
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

