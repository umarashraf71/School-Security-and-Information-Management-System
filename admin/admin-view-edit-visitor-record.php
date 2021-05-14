<?php

include('includes/header.php');

if(isset($_GET['deleteId']))
{
        $deleteId = $_GET['deleteId'];
        $query2 = "delete from visitor where v_id = '$deleteId' ";

        mysqli_query($con, $query2);

        $msg="Visitor Deleted Successfully !";
        $_SESSION['deleteMsg'] = $msg;
        header("refresh: 2; url=admin-view-edit-visitor-record.php");
}



?>  

<title> Admin | View & Edit Visitor </title>

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
        <h1 class="page-heading">Edit Visitor Record</h1>
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

    <div class="col-md-4">
        
        <div class="form-group has-search" > 

        <label for="sclass" >Search Visitor</label>
            <input type="text" class="form-control" id="search" placeholder="Enter to Search">
        </div>
        <input style="margin-top:0px !important" type="submit" value="Search" id="searchBtn" class="btn btn-sm float-right mt-3 btn-search" name="searchByRollNo">                        


    </div>
    </div>

</div>
   
                    

                    <?php

                        $query = "select * from visitor order by v_id desc limit 5";
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
                                    <th class="border-top-0">Visitor <small> ( CNIC ) </small></th>
                                    <th class="border-top-0">Visitor Name</th>
                                    <th class="border-top-0">Contact No</th>
                                    <th class="border-top-0">Visiting Date</th>
                                    <th class="border-top-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-data">

                            <?php

                                while($row = mysqli_fetch_array($result))
                                {
 
                            ?>
                                
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row['cnic']; ?></td>
                                    <td><?php echo ucfirst($row['name']); ?></td>
                                    <td><?php echo $row['contact']; ?></td>
                                    <td><?php echo date('d-m-Y', $row['visiting_date'] );  ?></td>
                                    <td>
                                        <a href="admin-view-visitor-record.php?id=<?php echo $row['v_id']; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                        <a href="admin-edit-visitor-record.php?id=<?php echo $row['v_id']; ?>" class="btn btn-primary btn-sm btn-action mr-1">Edit</a>
                                        <a onClick="return confirm('Are you sure you want to delete ?')"
                                            href="admin-view-edit-visitor-record.php?deleteId=<?php echo $row['v_id']; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>

                                    </td>
                                </tr>
                            
                            <?php

                                $count = $count + 1;
                                                                        
                                }

                            ?>    
                                
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
                                        echo "<h3 class='pt-5'> No Visitor Record Exists !</h3>";
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

                jQuery.ajax({

                    url:'ajax/admin-search-view-edit-visitor-record.php',
                    type: 'POST',
                    data:{
                        search:search
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
