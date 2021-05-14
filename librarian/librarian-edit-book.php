<?php

include('includes/header.php'); 

if(isset($_GET['id']))
{
    $editId = $_GET['id'];

    $query = "select * from library_books where book_id = '$editId'";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);
}

if(isset($_POST['submit']))
{
    $bookno = $_POST['bookno'];
    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $quantity = $_POST['quantity'];
    $edition = $_POST['edition'];
    $price = $_POST['price'];

    $query1 = "select * from library_books where book_no = '$bookno'";
    $result1 = mysqli_query($con,$query1);

    if($result1)
    {
        $rowCount1 = mysqli_num_rows($result1);
    }

    if($rowCount1 > 0)
    {
        $msg = "Book with No " . $bookno ." already exists !";
        $_SESSION['deleteMsg'] = $msg;
        header("refresh: 2; url=librarian-edit-book.php?id=$editId");
    }
    else
    {
        $query2 = "update library_books set book_no = '$bookno', book_name = '$bookname', author_name = '$authorname', book_price = '$price', edition = '$edition', quantity = '$quantity' where book_id = '$editId' ";
        $result2 = mysqli_query($con, $query2);

        if($result2)
        {
            $msg="Book Updated Successfully ";  
            $_SESSION['successMsg'] = $msg;
            header('location:librarian-view-edit-books.php');
        }

    }


}

?>  

<title>Librarian | Edit Book Record</title>

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
                                <h4 class="card-title">Edit Book Record</h4>
                                <h5 class="card-subtitle">Edit the Book Details</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    

        <form action="" method="POST" enctype="multipart/form-data" class="student-reg-form">

            <div class="form-group">
                <label for="title">Book No : </label>
                <input type="text" value="<?php echo $row['book_no']; ?>" name="bookno" class="form-control" id="bookno"
                    placeholder="Enter Book No " required maxlength="11"
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Book Name : </label>
                <input type="text" value="<?php echo $row['book_name'] ?>" name="bookname" class="form-control" id="bookname"
                    placeholder="Enter Book Name" required />
            </div>

            <div class="form-group">
                <label for="title">Author Name : </label>
                <input type="text" value="<?php echo $row['author_name'] ?>" name="authorname" class="form-control" id="authorname"
                    placeholder="Enter Author Name" required 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 
						&& event.charCode < 123) || (event.charCode == 32)"/>
            </div>

            <div class="form-group">
                <label for="title">Quantity : </label>
                <input type="number" value="<?php echo $row['quantity'] ?>" name="quantity" class="form-control" id="quantity"
                    placeholder="Enter Book Quantity" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
            </div>

            <div class="form-group">
                <label for="title">Edition :</label>
                <input type="text" value="<?php echo $row['edition'] ?>" name="edition" class="form-control" id="edition"
                    placeholder="Enter Book Edition" required />
            </div>

            <div class="form-group">
                <label for="title">Price (R<small>s</small>) :</label>
                <input type="number" value="<?php echo $row['book_price'] ?>" name="price" class="form-control" id="price"
                    placeholder="Enter Book Price" required 
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
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

<script>
    setTimeout(function()
        {
            $('#message').fadeOut('fast');
        }, 2500); // <-- time in milliseconds
</script>
