<?php

session_start();
include('../includes/config.php');
date_default_timezone_set("Asia/Karachi");


$query = "select * from student_attendence order by date desc limit 10";
$result = mysqli_query($con, $query);
$rowCount = mysqli_num_rows($result);
$count = 1;

if($rowCount > 0 )
{

?> 

<div id="displaystatus"></div>

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
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-data">

                        <?php        
                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['s_a_id'];

                        ?>
                            
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['roll_no']; ?></td>
                                <td><?php echo ucfirst($row['name']); ?></td>
                                <td>
                                    <?php 
                                    
                                    $classId = $row['class_id'];

                                    $query1 = "select * from class where class_id = '$classId'";
                                    $result1 = mysqli_query($con, $query1);
                                    
                                    $row1 = mysqli_fetch_array($result1);
                                    $className = $row1['class_name'];

                                    echo ucfirst($className); 
                                
                                    ?>
                                </td>
                                <td><?php echo ucfirst($row['section']); ?></td>
                                <td><?php echo date('d-m-Y' , $row['date']); ?></td>
                                <td style="letter-spacing:0.3px;">
                                
                                <?php

                                    if($row['status'] == 'present'){
                                ?>        

                                <strong class="text-success" ><?php echo ucfirst($row['status']); ?></strong></td>
                                
                                <?php
                                    }
                                
                                    if($row['status'] == 'absent'){
                                ?>

                                <strong class="text-danger" ><?php echo ucfirst($row['status']); ?></strong></td>
                                
                                <?php
                                    }
                                
                                    if($row['status'] == 'leave'){
                                ?>

                               <strong class="text-primary" ><?php echo ucfirst($row['status']); ?></strong></td>
                                
                               <?php
                                    }
                                ?>
                                
                                <td>
                                        
                                <?php

                                    if($row['status'] == 'present'){
                                

                                        echo "<a  class='btn btn-success btn-sm btn-action mr-1  disabled' href='javascript:void(0)' >Present</a>";
                                        echo   "<a rel='{$id}' class='btn btn-primary btn-sm btn-action mr-1 leave-link' href='javascript:void(0)' >Leave</a>";
                                        echo   "<a rel='{$id}' class='btn btn-danger btn-sm btn-action absent-link' href='javascript:void(0)' >Absent</a>";

                                
                                    }

                                    else if($row['status'] == 'absent'){

                                        echo "<a rel='{$id}' class='btn btn-success btn-sm btn-action mr-1 present-link' href='javascript:void(0)'>Present</a>";
                                        echo   "<a rel='{$id}' class='btn btn-primary btn-sm btn-action mr-1 leave-link' href='javascript:void(0)' >Leave</a>";
                                        echo   "<a  class='btn btn-danger btn-sm btn-action disabled' href='javascript:void(0)' >Absent</a>";

                                    }
                                
                                    else{
                                
                                        echo "<a rel='{$id}' class='btn btn-success btn-sm btn-action mr-1 present-link' href='javascript:void(0)'>Present</a>";
                                        echo   "<a  class='btn btn-primary btn-sm btn-action mr-1 disabled' href='javascript:void(0)' >Leave</a>";
                                        echo   "<a rel='{$id}' class='btn btn-danger btn-sm btn-action absent-link ' href='javascript:void(0)' >Absent</a>";

                                    }
                                
                                        ?>
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
                                    echo "<h3 class='pt-5'> No Attendence Record Exists !</h3>";
                                    echo "</div>";
                                }

                        ?> 





<script type="text/javascript">

$(document).ready(function(){

//#28a745;

$(".present-link").on('click', function(){


    if(confirm('Are you sure you want to mark Present ?')){

    var id1 = $(this).attr("rel");

    $.post("ajax/admin-change-student-attendence-status.php", 
      {
        presentId1:id1 
      },
      function(data){

        //$('#displaystatus').html(data);
        
      })

    }

});



$(".leave-link").on('click', function(){


if(confirm('Are you sure you want to mark Leave ?')){

var leaveId1 = $(this).attr("rel");

$.post("ajax/admin-change-student-attendence-status.php", 
  {
    leaveId1:leaveId1 
  },
  function(data){

    //$('#displaystatus').html(data);
    
  })

}

});



$(".absent-link").on('click', function(){


if(confirm('Are you sure you want to mark Absent ?')){

var absentId1 = $(this).attr("rel");

$.post("ajax/admin-change-student-attendence-status.php", 
  {
    absentId1:absentId1 
  },
  function(data){

    //$('#displaystatus').html(data);
    
  })

}

});


});

</script>


                        