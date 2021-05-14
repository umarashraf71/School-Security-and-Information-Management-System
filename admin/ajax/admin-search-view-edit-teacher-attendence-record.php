<?php

session_start();
include('../includes/config.php');
date_default_timezone_set("Asia/Karachi");


$errorFlag = 0;
$count = 0;


    //if no field is selected
    if( empty( $_POST['scnic'] ) && empty($_POST['sdate']) )
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }
    //if cnic field is selected
    else if( !empty( $_POST['scnic'] ) && empty($_POST['sdate']) )
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if date field is selected
    else if( empty( $_POST['scnic'] ) && !empty($_POST['sdate']) )
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }
    else
    {

        //if cnic and date is selected         
        if(!empty( $_POST['scnic'] ) && !empty($_POST['sdate']))
        {
            // echo "<div class='col-md-12 text-center mt-5'>";
            // echo "<h3 class='pt-5'> No Student Record Exists !</h3>";
            // echo "</div>";
            
            $scnic = $_POST['scnic'];  
            $scnic = preg_replace('/[^0-9]/', '', $scnic);
            $date = strtotime($_POST['sdate']);

            $query = "select * from teacher_attendence where t_cnic = '$scnic' and date = '$date' ";
            $result = mysqli_query($con, $query);

            if($result)
            {
                $count = mysqli_num_rows($result);
                
                //only for displaying error
                if($count > 0)
                {
                    $errorFlag = 0;
                }
                else{

                    $errorFlag = 1;
                }

            }
            else{

                echo "Query Failed";
            }

        }

    }



    
if($count > 0)
{

?>


    <div class="col-md-12 mt-4 edit-student-table" >
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
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Actions</th> 
                            </tr>
                        </thead>
                        <tbody class="table-data">
                            

                    <?php
                            $count1 = 1;

                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['t_a_id'];

                    ?>
                            <tr>
                                <td><?php echo $count1; ?></td>
                                <td><?php echo $row['t_cnic']; ?></td>
                                <td><?php echo ucfirst($row['name']); ?></td>
                                <td><?php echo date('d-m-Y' , $row['date']); ?></td>

                                <td style="letter-spacing:0.3px;" >
                                
                                <?php

                                    if($row['status'] == 'present'){
                                ?>        

                                <?php echo "<strong class='text-success' id='pdisplaystatus-".$row['t_a_id']."'>"; ?> 
                                    <?php echo ucfirst($row['status']); ?>
                                <?php echo "</strong>"; ?>

                                <?php echo "<strong id='displaystatus-".$row['t_a_id']."'></strong>"; ?>
                                
                                <?php
                                    }
                                
                                    if($row['status'] == 'absent'){
                                ?>

                                <?php echo "<strong class='text-danger' id='pdisplaystatus-".$row['t_a_id']."'>"; ?> 
                                    <?php echo ucfirst($row['status']); ?>
                                <?php echo "</strong>"; ?>

                                <?php echo "<strong id='displaystatus-".$row['t_a_id']."'></strong>"; ?>
                                 
                                <?php
                                    }
                                
                                    if($row['status'] == 'leave'){
                                ?>

                                <?php echo "<strong class='text-primary' id='pdisplaystatus-".$row['t_a_id']."'>"; ?> 
                                    <?php echo ucfirst($row['status']); ?>
                                <?php echo "</strong>"; ?>

                                <?php echo "<strong id='displaystatus-".$row['t_a_id']."'></strong>"; ?>
                                
                               <?php
                                  }
                                ?>
                                  </td> 
                                
                                <td>
                                        
                                <?php

                                    if($row['status'] == 'present'){
                                

                                        echo "<a rel='{$id}' class='btn btn-success btn-sm btn-action mr-1 present-link disabled' href='javascript:void(0)' id='pbutton-".$row['t_a_id']."' >Present</a>";
                                        echo   "<a rel='{$id}' class='btn btn-primary btn-sm btn-action mr-1 leave-link' href='javascript:void(0)' id='lbutton-".$row['t_a_id']."' >Leave</a>";
                                        echo   "<a rel='{$id}' class='btn btn-danger btn-sm btn-action absent-link' href='javascript:void(0)' id='abutton-".$row['t_a_id']."' >Absent</a>";

                                
                                    }

                                    else if($row['status'] == 'absent'){

                                        echo "<a rel='{$id}' class='btn btn-success btn-sm btn-action mr-1 present-link' href='javascript:void(0)' id='pbutton-".$row['t_a_id']."'>Present</a>";
                                        echo   "<a rel='{$id}' class='btn btn-primary btn-sm btn-action mr-1 leave-link' href='javascript:void(0)' id='lbutton-".$row['t_a_id']."'>Leave</a>";
                                        echo   "<a rel='{$id}' class='btn btn-danger btn-sm btn-action absent-link disabled' href='javascript:void(0)' id='abutton-".$row['t_a_id']."'>Absent</a>";

                                    }
                                
                                    else{
                                
                                        echo "<a rel='{$id}' class='btn btn-success btn-sm btn-action mr-1 present-link' href='javascript:void(0)' id='pbutton-".$row['t_a_id']."'>Present</a>";
                                        echo   "<a rel='{$id}'  class='btn btn-primary btn-sm btn-action mr-1 leave-link disabled' href='javascript:void(0)' id='lbutton-".$row['t_a_id']."'>Leave</a>";
                                        echo   "<a rel='{$id}' class='btn btn-danger btn-sm btn-action absent-link ' href='javascript:void(0)' id='abutton-".$row['t_a_id']."'>Absent</a>";

                                    }
                                
                                        ?>
                                </td>
                            </tr>

                        <?php

                                $count1 = $count1 + 1;
                                                                    
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
        if($errorFlag == 1)
        {
            echo "<div class='col-md-12 text-center mt-5'>";
            echo "<h3 class='pt-5'> No Teacher Record Found !</h3>";
            echo "</div>";
        }

    }


?>                        


<script type="text/javascript">

$(document).ready(function(){

//#28a745;

$(".present-link").on('click', function(){


    if(confirm('Are you sure you want to mark Present ?')){

    var presentId = $(this).attr("rel");
    //var displayStatus = $('#displaystatus-' + presentId).html(data);
    //var button = $('#button-' + presentId).html(data);
    
    $.post("ajax/admin-change-teacher-attendence-status.php", 
      {
        presentId:presentId 
      },
      function(data){


        $('#pdisplaystatus-' + presentId).hide();
        $('#displaystatus-' + presentId).html(data);
        //alert(data);
        
        $('#displaystatus-' + presentId).removeClass('text-danger');
        $('#displaystatus-' + presentId).removeClass('text-primary');
        $('#displaystatus-' + presentId).addClass('text-success');
        $('#displaystatus-' + presentId).css('textTransform', 'capitalize');
        
        $('#pbutton-' + presentId).addClass('disabled');
        $('#lbutton-' + presentId).removeClass('disabled');
        $('#abutton-' + presentId).removeClass('disabled');  
      })

    }

});



$(".leave-link").on('click', function(){


if(confirm('Are you sure you want to mark Leave ?')){

var leaveId = $(this).attr("rel");

$.post("ajax/admin-change-teacher-attendence-status.php", 
  {
    leaveId:leaveId 
  },
  function(data){


        $('#pdisplaystatus-' + leaveId).hide();
        $('#displaystatus-' + leaveId).html(data);
        
        //alert(data);
        $('#displaystatus-' + leaveId).removeClass('text-danger');
        $('#displaystatus-' + leaveId).removeClass('text-success');
        $('#displaystatus-' + leaveId).addClass('text-primary');
        $('#displaystatus-' + leaveId).css('textTransform', 'capitalize');

        $('#lbutton-' + leaveId).addClass('disabled');
        $('#pbutton-' + leaveId).removeClass('disabled');
        $('#abutton-' + leaveId).removeClass('disabled');  

  })

}

});



$(".absent-link").on('click', function(){


if(confirm('Are you sure you want to mark Absent ?')){

var absentId = $(this).attr("rel");

$.post("ajax/admin-change-teacher-attendence-status.php", 
  {
    absentId:absentId 
  },
  function(data){

       $('#pdisplaystatus-' + absentId).hide();
        $('#displaystatus-' + absentId).html(data);
        //alert(data);

        $('#displaystatus-' + absentId).removeClass('text-primary');
        $('#displaystatus-' + absentId).removeClass('text-success');
        $('#displaystatus-' + absentId).addClass('text-danger');
        $('#displaystatus-' + absentId).css('textTransform', 'capitalize');
        
        $('#abutton-' + absentId).addClass('disabled');
        $('#lbutton-' + absentId).removeClass('disabled');
        $('#pbutton-' + absentId).removeClass('disabled');  


})

}

});


});

</script>