<?php

    include('includes/header.php');

?>  


<title> Admin | View & Edit Teacher Attendence </title>

<style>
.table-data tr:hover{

background-color: #fff !important;
transition: 0.3s !important;
}

.btn-success:hover{

    background-color: #28a745 !important;
    border-color: #28a745 !important;

}
.btn-success{
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}

.btn-primary:hover{

background-color: #007bff !important;
border-color: #007bff !important;

}
.btn-primary{
background-color: #007bff !important;
border-color: #007bff !important;
}

.btn-danger:hover{

background-color: #bd2130 !important;
border-color: #bd2130 !important;
}
.btn-danger{
background-color: #bd2130 !important;
border-color: #bd2130 !important;
}


</style>

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
            <h1 class="page-heading">Edit Teacher Attendence</h1>
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



    <div class="row mt-2 mb-0 p-1">
    
        <div class="col-md-6 select-edit-student" >
            <div class="form-group has-search ">
                <label for="sclass" >Select Date</label>
                    <input type="date" name="date" id="date" class="form-control" placeholder="Select Date">
            </div>
        </div>


        <div class="col-md-6">     
            <div class="form-group has-search" >
                <label for="sclass" >Enter Teacher CNIC</label> 
                <input type="text" maxlength="15" class="form-control" id="cnic" placeholder="Enter CNIC i.e 35603-2006787-1">
            </div>
            
            <input style="margin-top:0px !important" type="submit" value="Search" id="searchBtn" class="btn btn-sm float-right mt-3 btn-search" name="searchByRollNo">                        

        </div>

      </div>

    </div>
       


<div id="show-search-table" class="w-100"></div>

<div id="show-attendence-table" class="w-100"></div>

<div class='col-md-12 text-center mt-5'>
<h3 class='pt-5' id="display"></h3>
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


$(document).ready(()=>{



 var interval1;
 var interval2;

    interval1 = setInterval(function(){

        updateAttendence();

    }, 500);



    //function to display all the student attendence record from the database
    function updateAttendence(){

    $.ajax({

        url:'ajax/admin-show-teacher-attendence.php',
        type:'POST',
        success: function(data){

            if(!data.error){

                $("#show-attendence-table").html(data);
            }
        }
    });

    } 




    $('#searchBtn').click(function(){

        clearInterval(interval1);   

        var scnic = $('#cnic').val();
        var sdate = $('#date').val();

        $('#show-attendence-table').hide();

        jQuery.ajax({

            url:'ajax/admin-search-view-edit-teacher-attendence-record.php',
            type: "POST",
            data:{
                scnic:scnic,
                sdate:sdate
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
