<?php

    include('includes/header.php');

?>  

<title>Librarian | Dashboard</title>

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
     <div class="row">


        <!-- Page Heading -->
    <div class="col-md-12 mt-lg-2  mb-3">     
        <div class="">
            <h1 class="page-heading mt-5 mb-4 pl-1">Librarian Dashboard</h1>
            <!-- <h3 class="h3 mt-3">Section A</h3> -->
        </div>
    </div>

    <div class="col-md-12">
     <div class="row">
     
      
    <div class="col-sm-4">
        <div class="card zoom">
        <a href="librarian-add-books.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/add-book.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="librarian-add-books.php"> Add Books </a></h3>
                <div class="mb-1">

                <?php
                
                $query1 = "select * from library_books";
                $result1 = mysqli_query($con, $query1);

                if($result1)
                {
                    $count1 = mysqli_num_rows($result1);
                }
            
                ?>

                    <span class="text-primary text-uppercase">Total Books ( <?php echo $count1; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card zoom">
        <a href="librarian-view-edit-books.php">
            <div class="card-body text-center">
                <img class="imgg" src="assets/images/front-icons/manage-book.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="librarian-view-edit-books.php"> Edit Books </a> </h3>
                <div class="mb-1">
                
                <?php
                
                    $query2 = "select * from library_books";
                    $result2 = mysqli_query($con, $query2);

                    if($result2)
                    {
                        $count2 = mysqli_num_rows($result2);
                    }
                
                ?>

                    <span class="text-primary text-uppercase">Total Books ( <?php echo $count2; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card zoom">
            <div class="card-body text-center">
            <a href="librarian-view-issued-books.php">
                <img class="imgg" src="assets/images/front-icons/issue-book.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="librarian-view-issued-books.php"> Issued Books </a> </h3>
                <div class="mb-1">

                <?php
                
                $query4 = "select * from library_issue_books where status = 'issued' ";
                $result4 = mysqli_query($con, $query4);

                if($result4)
                {
                    $count4 = mysqli_num_rows($result4);
                }
            
            ?>
                    <span class="text-primary text-uppercase">Total Issued Books ( <?php echo $count4; ?> )</span>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card zoom">
        <a href="librarian-view-returned-books.php">
            <div class="card-body text-center">
                <img class="imgg ml-4" src="assets/images/front-icons/like.png" alt="">
                <h3 class="text-uppercase mt-2 mb-0"> <a href="librarian-view-returned-books.php"> Returned Books </a> </h3>
                <div class="mb-1">
                <?php
                
                $query5 = "select * from library_issue_books where status = 'returned' ";
                $result5 = mysqli_query($con, $query5);

                if($result5)
                {
                    $count5 = mysqli_num_rows($result5);
                }
            
            ?>
                    <span class="text-primary text-uppercase">Total Returned Books ( <?php echo $count5; ?> )</span>
                </div>
            </div>
            </a>
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

