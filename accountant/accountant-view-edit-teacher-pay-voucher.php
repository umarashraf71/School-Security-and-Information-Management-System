<?php

include('includes/header.php');


if(isset($_GET['deleteId']))
{
        $deleteId = $_GET['deleteId'];
        $query2 = "delete from teacher_voucher where t_v_id = '$deleteId' ";
    
        mysqli_query($con, $query2);
    
        $msg="Teacher Voucher Deleted Successfully !";
        $_SESSION['deleteMsg'] = $msg;
        header("refresh: 2; url=accountant-view-edit-teacher-pay-voucher.php");
}



?>  

<title>Accountant | View & Edit Teacher Pay Voucher</title>

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
        <h1 class="page-heading">Edit Teacher Pay Voucher</h1>
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

            <label for="sclass" >Search by CNIC</label>
                <input type="text" maxlength="15" id="cnic" class="form-control" placeholder="Enter CNIC i.e 35603-2006787-1">
            </div>
            <input style="margin-top:0px !important" type="submit" value="Search" id="searchBtn" class="btn btn-sm float-right mt-3 btn-search" name="searchByRollNo">                        

        </div>
    </div>
</div>
   
                    
                        <?php

                            $query = "select * from teacher_voucher order by issue_date desc limit 7";
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
                                        <th class="border-top-0">Teacher <small> ( CNIC ) </small></th>
                                        <th class="border-top-0">Teacher Name</th>
                                        <th class="border-top-0">Issue Date</th>
                                        <th class="border-top-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-data">
                                    
                                <?php        
                                  while($row = mysqli_fetch_array($result))
                                  {
                                    $id = $row['t_v_id'];
                                ?>

                                    <tr> 
                                    <td><?php echo $count; ?></td>
                                        <td><?php echo $row['cnic']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo date('d-m-Y' , $row['issue_date']); ?>
                                        <td>
                                            <a href="accountant-view-teacher-voucher.php?id=<?php echo $id ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                            <a href="accountant-edit-teacher-pay-voucher.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm btn-action mr-1">Edit</a>
                                            <a  onClick="return confirm('Are you sure you want to delete ?')"  
                                            href="accountant-view-edit-teacher-pay-voucher.php?deleteId=<?php echo $id ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
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
                                        echo "<h3 class='pt-5'> No Voucher Record Exists !</h3>";
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

        url:'ajax/accountant-search-view-edit-teacher-pay-voucher.php',
        type: "POST",
        data:{
            cnic:cnic
        },
        success: function(data){


                $('#show-search-table').html(data);
                $('#show-default-table').hide();
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
