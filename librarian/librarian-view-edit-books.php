<?php

    include('includes/header.php');

    if(isset($_GET['deleteId']))
    {
            $deleteId = $_GET['deleteId'];
            $query2 = "delete from library_books where book_id = '$deleteId' ";
    
            mysqli_query($con, $query2);

            $msg="Book Record Deleted Successfully !";
            $_SESSION['deleteMsg'] = $msg;
            header("refresh: 2; url=librarian-view-edit-books.php");
    }

?>  

<title>Librarian | View & Edit Books</title>

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
            <h1 class="page-heading">Edit Books Record</h1>
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

            <label for="sclass" >Search By Date</label>
                <input type="date" class="form-control" name="sdate" id="sdate" placeholder="Enter to Search">
            </div>

            <input style="margin-top:0px !important" type="submit" value="Search" id="searchBtn" class="btn btn-sm float-right mt-3 btn-search" name="searchByRollNo">                        

        </div>

        </div>

    </div>
       
                        
  <?php

                        $query = "select * from library_books order by date desc limit 7 ";
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
                                        <th class="border-top-0">Author</th>
                                        <th class="border-top-0">Edition</th>
                                        <th class="border-top-0">Quantity</th>
                                        <th class="border-top-0">Price <small>(Rs)</small></th>
                                        <th class="border-top-0">Date</th>
                                        <th class="border-top-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-data">
                                
                                <?php

                                while($row = mysqli_fetch_array($result))
                                {
                                    $id = $row['book_id'];
                                ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['book_no']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td><?php echo $row['author_name']; ?></td>
                                        <td><?php echo $row['edition']; ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['book_price']; ?></td>
                                        <td><?php echo date('d-m-Y', $row['date'] );  ?></td>
                                        <td>
                                            <a href="librarian-edit-book.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm btn-action mr-1">Edit</a>
                                            <a onClick="return confirm('Are you sure you want to delete ?')" 
                                                href="librarian-view-edit-books.php?deleteId=<?php echo $id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
                                        </td>
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

                    url:'ajax/librarian-search-view-edit-books.php',
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
