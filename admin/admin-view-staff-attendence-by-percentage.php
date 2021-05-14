<?php

include('includes/header.php');

?>  

<title>Admin | View Staff Attendence Percentage</title>


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
        <h1 class="page-heading">View Staff Attendence Percentage</h1>
        <!-- <h3 class="h3 mt-3">Section A</h3> -->
    </div>
</div>


<!-- <div class="row">
</div> -->


<div class="col-md-12 mt-lg-2  mb-0">   
    
<div class="row mt-2 mb-0">

    <div class="col-md-8 select-edit-student" style="padding:0px !important;">

    <div class="form-group col-md-6 has-search float-left" style="margin-bottom:-10px !important">

        <label for="sclass" >Select Start Date</label>
            <input type="date" name="startDate" id="startDate" class="form-control" placeholder="Select End Date">
    </div>

    <div class="form-group col-md-6 has-search float-left" style="margin-bottom:-10px !important">

        <label for="sclass" >Select End Date</label>
            <input type="date" name="endDate" id="endDate" class="form-control" placeholder="Select End Date">
    </div>    


    </div>


    <div class="col-md-4">
        
        <div class="form-group has-search" >

        <label for="sclass" >Enter CNIC </label>
            <input maxlength="15" type="text" class="form-control" id="cnic" placeholder="Enter CNIC i.e 35603-2006787-1">
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
   
   //Search Student Record
   $(document).ready(function(){


       // $('#show-default-table').hide();

       $('#searchBtn').click(function(){

           var startdate = $('#startDate').val();
           var enddate = $('#endDate').val();
           var scnic = $('#cnic').val();

           jQuery.ajax({

               url:'ajax/admin-search-view-staff-attendence-by-percentage.php',
               type: "POST",
               data:{
                   startdate:startdate,
                   enddate:enddate, 
                   scnic:scnic
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
