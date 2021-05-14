<?php

include('includes/header.php');

?>  

<title>Accountant | Create Single Fee Voucher</title>

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
        <h1 class="page-heading">Create Student Voucher</h1>
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

    </div>


<div class="row mt-2 mb-0"> 

    <div class="col-md-8 select-edit-student" style="padding:0px !important;">


    <div class="form-group col-md-6 float-left">
        <label for="sclass" >Select Class</label>
        <select class="form-control" name="sclass" id="sclass" required>
            <option value="">Select Class</option>        

            <?php

                $query0 = "select * from class";
                $result0 = mysqli_query($con, $query0);

                while($row0 = mysqli_fetch_array($result0))
                {
            ?>
                        
                <option value="<?php echo $row0['class_id'] ?>" >
                    <?php echo ucfirst($row0['class_name']); ?>
                </option>          

            <?php
            
                }
            
            ?>
        </select>
    </div>

            <div class="form-group col-md-6 float-left">
                <label for="ssection" >Select Section</label>
                <select class="form-control" name="ssection" id="ssection" required>
                    <option value="">Select Section</option>     
                        <option value="section A" >Section A</option>
                        <option value="section B">Section B</option>
                        <option value="section C">Section C</option>
                </select>

            </div>

    </div>

    <div class="col-md-4">
        
        <div class="form-group has-search" >

        <label for="sclass" >Enter Roll Number</label>
            <input type="text" class="form-control" placeholder="Enter Roll Number" id="srollno">
        </div>
        <input style="margin-top:0px !important" type="submit" value="Search" id="searchBtn" class="btn btn-sm float-right mt-3 btn-search" name="searchByRollNo">                        

    </div>
    </div>

</div> 


<div id="show-search-table" class="w-100"></div>

                          

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

    //Search Student Record
    $(document).ready(function(){


        $('#searchBtn').click(function(){

            var sclass = $('#sclass').val();
            var ssection = $('#ssection').val();
            var srollno = $('#srollno').val();

            jQuery.ajax({

                url:'ajax/accountant-search-view-create-single-student-voucher.php',
                type: "POST",
                data:{
                    sclass:sclass,
                    ssection:ssection,
                    srollno:srollno
                },
                success: function(data){

                    $('#show-search-table').html(data);

                },
                error:function(){}

            });

        });

    });
            
</script>         

</html>
