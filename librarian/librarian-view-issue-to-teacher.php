<?php

include('includes/header.php');

?>  

<title>Librarian | View & Issue to Teacher</title>

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
        <h1 class="page-heading">Issue Book To Teacher</h1>
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

            <label for="sclass" >Teacher CNIC</label>
                <input maxlength="15" type="text" class="form-control" id="cnic" name="cnic" placeholder="Enter CNIC i.e 35603-2006787-1">
            </div>
 
            <input style="margin-top:0px !important" type="submit" value="Search" id="searchBtn" class="btn btn-sm float-right mt-3 btn-search" name="searchByCnic">                        

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

    $('#cnic').keydown(function(){

    //allow  backspace, tab, ctrl+A, escape, carriage return
    if (event.keyCode == 8 || event.keyCode == 9 
        || event.keyCode == 27 || event.keyCode == 13 
        || (event.keyCode == 65 && event.ctrlKey === true) )
            return;
        if((event.keyCode < 48 || event.keyCode > 57))
        event.preventDefault();

        var length = $(this).val().length; 
                    
        if(length == 5 || length == 13)
        $(this).val($(this).val()+'-');

    });

</script> 

<script>

 
$(document).ready(()=>{


$('#searchBtn').click(function(){

var cnic = $('#cnic').val();

jQuery.ajax({

    url:'ajax/librarian-search-view-issue-to-teacher.php',
    type: "POST",
    data:{
        cnic:cnic
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
