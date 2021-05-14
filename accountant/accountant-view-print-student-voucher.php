<?php

include('includes/header.php');

?>  

<title>Accountant | View Student Vouchers</title>

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
        <h1 class="page-heading">View Student Vouchers</h1>
        <!-- <h3 class="h3 mt-3">Section A</h3> -->
    </div>
</div>


<!-- <div class="row">
</div> -->


<div class="col-md-12 mt-lg-2  mb-0">    
    
<div class="row mt-2 mb-0">

    <div class="col-md-8 select-edit-student" style="padding:0px !important;">

     <div class="form-group col-md-6 has-search float-left" style="margin-bottom:-10px !important">

        <label for="sclass" >Select Issue Date</label>
            <input type="date" name="sdate" id="sdate" class="form-control" placeholder="Select Issue Date">
    </div>

    <div class="form-group col-md-6 float-left">
        <label for="sclass" >Select Class</label>
         <select class="form-control" name="sclass" id="sclass" required>
            <option value="">Select Class</option>        

                <?php

                    $query3 = "select * from class";
                    $result3 = mysqli_query($con, $query3);

                    while($row3 = mysqli_fetch_array($result3))
                    {
                ?>
                            
                    <option value="<?php echo $row3['class_id'] ?>" >
                        <?php echo ucfirst($row3['class_name']); ?>
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
            <input type="text" class="form-control" name="srollno" id="srollno" placeholder="Enter Roll Number">
        </div>
            
        <input style="margin-top:0px !important" type="submit" value="Search" id="searchBtn" class="btn btn-sm float-right mt-3 btn-search" name="searchByRollNo">                        

    </div>
    </div>

</div> 
   


    <!-- <div class="col-md-12 mt-lg-2  mb-0">     
        <div class=" mt-3" >
            <a style="background-color:#56bbfa !important; margin-bottom:-40px !important; color:#222e3c; font-size:13.5px !important; font-weight:500 !important; padding: 5px 10px !important;" id="searchByRollNo" class="btn btn-primary btn-sm float-right btn-search" name="searchByRollNo"><i class="fas fa-print"></i> Print</a>                        
        </div>
    </div> -->
   
                        <?php

                            $query = "select * from student_voucher order by issue_date desc limit 7";
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
                                    <th class="border-top-0">Roll No</th>
                                    <th class="border-top-0">Student Name</th>
                                    <th class="border-top-0">Class</th>
                                    <th class="border-top-0">Section</th>
                                    <th class="border-top-0">Issue Date</th>
                                    <th class="border-top-0">Due Date</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-data">
                            
                            <?php        
                                  while($row = mysqli_fetch_array($result))
                                  {
                                    $id = $row['s_v_id'];
                            ?>
                            
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row['roll_no']; ?></td>
                                    <td><?php echo ucfirst($row['name']); ?></td>
                                    <td>
                                        <?php 
                                        
                                        $classId = $row['class'];

                                        $query1 = "select * from class where class_id = '$classId'";
                                        $result1 = mysqli_query($con, $query1);
                                        
                                        $row1 = mysqli_fetch_array($result1);
                                        $className = $row1['class_name'];
    
                                        echo ucfirst($className); 
                                    
                                        ?>
                                    </td>
                                    <td><?php echo ucfirst($row['section']); ?></td>
                                    <td><?php echo date('d-m-Y' , $row['issue_date']); ?></td>
                                    <td><?php 
                                        
                                        if($row['due_date'] == "" || $row['due_date'] == null)
                                        {
                                            echo "None";
                                        }
                                        else
                                        {
                                            echo date('d-m-Y' , $row['due_date']); 
                                        }
                                        
                                        ?>
                                    </td>
                                    
                                    <td><?php echo ucfirst($row['status']); ?></td>
                                    <td>
                                        <a href="accountant-view-student-voucher.php?id=<?php echo $id ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
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


$(document).ready(()=>{


    $('#searchBtn').click(function(){


    var sclass = $('#sclass').val();
    var ssection = $('#ssection').val();
    var srollno = $('#srollno').val();
    var sdate = $('#sdate').val();

 
    jQuery.ajax({

        url:'ajax/accountant-search-view-print-student-voucher.php',
        type: "POST",
        data:{
            sclass:sclass,
            ssection:ssection,
            srollno:srollno,
            sdate:sdate
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


</html>
