<?php

include('includes/header.php');

if(isset($_GET['deleteId']))
{
    $deleteId = $_GET['deleteId'];
    $query2 = "delete from expense where x_id = '$deleteId' ";

    mysqli_query($con, $query2);

    $msg="Expense Deleted Successfully !";
    $_SESSION['deleteMsg'] = $msg;
    header("refresh: 2; url=accountant-view-edit-expenses.php");
}


?>  

<title> Accountant | View & Edit Expenses </title>

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
        <h1 class="page-heading">Edit Student Voucher</h1>
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

    <div class="col-md-6 select-edit-student" style="padding:0px !important;">

     <div class="form-group col-md-12 has-search float-left" style="margin-bottom:-10px !important">

        <label for="sclass" >Select Expense Date</label>
            <input type="date" name="xdate" id="xdate" class="form-control" placeholder="Select Issue Date">
    </div>

    </div>

    <div class="col-md-6">
        
        <div class="form-group has-search" >

        <label for="sclass" >Enter Expense Name</label>
            <input type="text" name="expense" id="expense" class="form-control" placeholder="Enter Expense Name">
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

$(document).ready(function(){


$('#searchBtn').click(function(){


var expense = $('#expense').val();
var xdate = $('#xdate').val();


jQuery.ajax({

    url:'ajax/accountant-search-view-edit-expenses.php',
    type: "POST",
    data:{
        expense:expense,
        xdate:xdate
    },
    success: function(data){


            $('#show-search-table').html(data);

    },
    error:function(){}

});




});    



});

</script>






<script>
    setTimeout(function()
        {
            $('#message').fadeOut('fast');
        }, 2700); // <-- time in milliseconds
</script>


</html>
