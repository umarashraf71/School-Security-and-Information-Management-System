<?php

    include('includes/header.php');


    if(isset($_GET['deleteId']))
    {
            $deleteId = $_GET['deleteId'];
            $query2 = "delete from library_issue_books where l_ib_id = '$deleteId' ";
    
            mysqli_query($con, $query2);

            $msg="Book Record Deleted Successfully !";
            $_SESSION['deleteMsg'] = $msg;
            header("refresh: 2; url=librarian-view-issued-books.php");
    }


     
    if(isset($_GET['r_id']))
    {
            $updatestatusid = $_GET['r_id'];

            $query2 = "update library_issue_books set status = 'returned' where l_ib_id = '$updatestatusid' ";
    
            mysqli_query($con, $query2);

            $msg="Book Status Changed to Returned Successfully !";
            $_SESSION['successMsg'] = $msg;
            header("refresh: 2; url=librarian-view-issued-books.php");
    }


?>  

<title>Librarian | View Issued Books</title>

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
<div class="col-md-12 mt-lg-2  mb-0">     
        <div class="">
            <h1 class="page-heading">View Issued Books</h1>
            <!-- <h3 class="h3 mt-3">Section A</h3> -->
        </div>
    </div>


    <!-- <div class="row">
    </div> -->


    <div class="col-md-12 mt-lg-2  mb-0">   

    <div class="row">
            	<!-- Notify message	--> 
		<?php if(!empty($_SESSION['successMsg'])) { ?>

            <div class="alert alert-success 
                        text-center offset-md-3 
                        col-md-6" id = "message">
                <strong style="font-size:16px;">
                    <?php echo htmlentities($_SESSION['successMsg']);?>
                    <?php echo htmlentities($_SESSION['successMsg']="");?>
                </strong>
            </div>

        <?php } ?>


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
         
        <div class="row mt-2 mb-0">
        
        <div class="col-md-6">
            
            <div class="form-group has-search" >

            <label for="sclass" >Search by Keyword</label>
                <input type="text" class="form-control" id="search" placeholder="Enter to Search">
            </div>

        </div>

        <div class="col-md-6">
            
            <div class="form-group has-search" >

            <label for="sclass" >Search by Issue Date</label>
                <input type="date" class="form-control" name="sdate" id="sdate" placeholder="Enter to Search">
            </div>

            <input style="margin-top:0px !important" type="submit" value="Search" id="searchBtn" class="btn btn-sm float-right mt-3 btn-search" name="searchByRollNo">                        

        </div>

        </div>

    </div>
       
                        
                        
  <?php

                        $query = "select * from library_issue_books where status = 'issued' order by l_ib_id desc limit 10 ";
                        $result = mysqli_query($con, $query);
                        $rowCount = mysqli_num_rows($result);
                        $count = 1;

                        if($rowCount > 0 )
                        {

                    ?>

<div id="show-search-table" class="w-100"></div>

          <!-- column -->
          <div class="col-md-12 mt-4 edit-student-table" id="show-default-table">
                    <div class="card">
                    <!-- <div class="card-body student-card-body">
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Student Record : Class 7 </h4>
                        <h5 class="card-subtitle">Section A</h5>
                    </div>
                </div>
            </div> -->


                        <div class="table-responsive">
                            <table class="table v-middle">
                                <thead >
                                    <tr class="table-header">
                                        <th class="border-top-0">Sr #</th>
                                        <th class="border-top-0">Book No</th>
                                        <th class="border-top-0">Book Name</th>
                                        <th class="border-top-0">Receiver Name</th>
                                        <th class="border-top-0">Receiver Type</th>
                                        <th style="width:10% !important" class="border-top-0">Issue Date</th>
                                        <th style="width:10% !important" class="border-top-0">Return Date</th>
                                        <th class="border-top-0">Status</th>
                                        <th style="width:23% !important" class="border-top-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-data">
                                    
                                <?php

                                while ($row = mysqli_fetch_array($result)) {
                                    
                                    $b_id = $row['l_ib_id']; 
                                    
                                ?>

                                    <tr>
                                        <td><?php echo $count; ?></td>


                        <?php   //Start receiver type Student

                            if ($row['type'] == 'student') 
                            {

                                $s_id = $row['s_id'];

                                $query1 = "select * from student where s_id = '$s_id' ";
                                $result1 = mysqli_query($con, $query1);

                                if($result1)
                                {
                                    $row1 = mysqli_fetch_array($result1);
                                }
                                
                        ?>
 
                                        <td><?php echo $row['book_no']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td><?php echo ucfirst($row1['name']); ?></td>
                                        <td><?php echo ucfirst($row['type']); ?></td>
                                        <td><?php echo date('d-m-Y', $row['issue_date'] );  ?></td>
                                        <td><?php echo date('d-m-Y', $row['return_date'] );  ?></td>
                                        <td><?php echo ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="librarian-view-book-details.php?s_id=<?php echo $s_id; ?>&b_id=<?php echo $b_id; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                            <a onClick="return confirm('Are you sure this book has been returned ?')" href="librarian-view-issued-books.php?r_id=<?php echo $b_id; ?>" class="btn btn-primary btn-sm btn-action mr-1">Returned</a>
                                            <a onClick="return confirm('Are you sure you want to delete ?')" href="librarian-view-issued-books.php?deleteId=<?php echo $b_id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
                                        
                                        </td>

                        <?php
                            } //End receiver type Student
                        ?>                



                        <?php   //Start receiver type Teacher

                            if ($row['type'] == 'teacher') 
                            {

                                $t_id = $row['t_id'];

                                $query2 = "select * from teacher where t_id = '$t_id' ";
                                $result2 = mysqli_query($con, $query2);

                                if($result2)
                                {
                                    $row2 = mysqli_fetch_array($result2); 
                                }
                                
                        ?>
 
                                        <td><?php echo $row['book_no']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td><?php echo ucfirst($row2['name']); ?></td>
                                        <td><?php echo ucfirst($row['type']); ?></td>
                                        <td><?php echo date('d-m-Y', $row['issue_date'] );  ?></td>
                                        <td><?php echo date('d-m-Y', $row['return_date'] );  ?></td>
                                        <td><?php echo ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="librarian-view-book-details.php?t_id=<?php echo $t_id; ?>&b_id=<?php echo $b_id; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                            <a onClick="return confirm('Are you sure this book has been returned ?')" href="librarian-view-issued-books.php?r_id=<?php echo $b_id; ?>" class="btn btn-primary btn-sm btn-action mr-1">Returned</a>
                                            <a onClick="return confirm('Are you sure you want to delete ?')" href="librarian-view-issued-books.php?deleteId=<?php echo $b_id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
                                        </td>

                        <?php
                            } //End Receiver type Teacher 
                        ?>                



                        <?php   //Start receiver type Staff

                            if ($row['type'] == 'staff') 
                            {

                                $st_id = $row['st_id'];

                                $query3 = "select * from staff where st_id = '$st_id' ";
                                $result3 = mysqli_query($con, $query3);

                                if($result3)
                                {
                                    $row3 = mysqli_fetch_array($result3);
                                }
                                
                        ?>
 
                                        <td><?php echo $row['book_no']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td><?php echo ucfirst($row3['name']); ?></td>
                                        <td><?php echo ucfirst($row['type']); ?></td>
                                        <td><?php echo date('d-m-Y', $row['issue_date'] );  ?></td>
                                        <td><?php echo date('d-m-Y', $row['return_date'] );  ?></td>
                                        <td><?php echo ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="librarian-view-book-details.php?st_id=<?php echo $st_id; ?>&b_id=<?php echo $b_id; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                            <a onClick="return confirm('Are you sure this book has been returned ?')" href="librarian-view-issued-books.php?r_id=<?php echo $b_id; ?>" class="btn btn-primary btn-sm btn-action mr-1">Returned</a>
                                            <a onClick="return confirm('Are you sure you want to delete ?')" href="librarian-view-issued-books.php?deleteId=<?php echo $b_id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
                                        </td>

                        <?php
                            } //End Receiver type Staff 
                        ?>                




                                    </tr>
                                    
                                <?php

                                    $count = $count + 1;
                                                                            
                                } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                                <?php
  
                                    }
                                    else
                                    {
                                        echo "<div class='col-md-12 text-center mt-5'>";
                                        echo "<h3 class='pt-5'> No Book Record Exists !</h3>";
                                        echo "</div>";
                                    }

                                ?>

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

// include('includes/footer.php');

?>	


</body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="vendor/js/jquery/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
    <script src="vendor/js/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/js/jquery/jquery.js"></script>
   
    <script>
    
        // $('#bar').click(function(){
        //     $(this).toggleClass('is-closed');
        //     $('#page-content-wrapper ,#sidebar-wrapper, #footer').toggleClass('toggled' );
        //     $('.topbar-img').toggleClass('logo-display');    
        // });

        // $(document).ready(function() {
        //     $('.sideNav').click(function() {
        //         $('a.active').removeClass("active");
        //         $(this).addClass("active");
        //     });
        // });

        $('#bar').click(function(){
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper, #footer').toggleClass('toggled' );
            $('.topbar-img').toggle();    
        });

        $(document).ready(function() {
            $('.sideNav').click(function() {
                $('a.active').removeClass("active");
                $(this).addClass("active");
            });
        });
                
    </script>


<script>
        setTimeout(function()
			{
				$('#message').fadeOut('fast');
			}, 2500); // <-- time in milliseconds
	</script>

<script>
        
    $(document).ready(() => {

        $('#searchBtn').click(() => {

            var search = $('#search').val();
            var sdate = $('#sdate').val();

            jQuery.ajax({

                url:'ajax/librarian-search-view-issued-books.php',
                type: 'POST',
                data:{
                    search:search,
                    sdate:sdate
                },
                success:(data)=>{

                    $('#show-search-table').html(data);
                    $('#show-default-table').hide();
                },
                error:()=>{}

            });

        })

    });
    
</script>        


</html>
