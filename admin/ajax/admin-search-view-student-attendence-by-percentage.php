<?php

session_start();
include('../includes/config.php');
date_default_timezone_set("Asia/Karachi");


$errorFlag = 0;
$count = 0;
$unixStartDate = strtotime($_POST['startdate']);
$unixEndDate = strtotime($_POST['enddate']);    

    //if end date is greater than start date
    if($unixEndDate < $unixStartDate)
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> End Date is Less than Start Date !</h3>";
        echo "</div>";
        
    }
    //if no field is selected
    else if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']) && empty($_POST['startdate']) && empty($_POST['enddate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if class,roll_no start and end field is selected
    else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && !empty($_POST['startdate']) && !empty($_POST['enddate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if class, start and end field is selected
    else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']) && !empty($_POST['startdate']) && !empty($_POST['enddate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    // //if class field is selected
    // else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']) && empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if section field is selected
    // else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']) && empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if roll_no field is selected
    // else if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if date & class field is selected
    // else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']) && !empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if date & section field is selected
    // else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']) && !empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if date & roll field is selected
    // else if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && !empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if class & section field is selected
    // else if(!empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']) && empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if date & roll $class field is selected
    // else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && !empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if date & roll $section field is selected
    // else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['srollno']) && !empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if class & roll $section field is selected
    // else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    // //if section & roll $section field is selected
    // else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['srollno']) && empty($_POST['sdate']))
    // {
    //     echo "<div class='col-md-12 text-center mt-5'>";
    //     echo "<h3 class='pt-5'> Invalid Selection !</h3>";
    //     echo "</div>";
        
    // }

    else
    {

        //if class, section, roll_no, start date and end date is selected         
        if( !empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['srollno']) && !empty($_POST['startdate']) && !empty($_POST['enddate']) )
        {
            // echo "<div class='col-md-12 text-center mt-5'>";
            // echo "<h3 class='pt-5'> No Student Record Exists !</h3>";
            // echo "</div>";
            
            $class_id = $_POST['sclass'];
            $section = $_POST['ssection'];
            $rollno = $_POST['srollno'];

            $startdate = $_POST['startdate'];

            $enddate = $_POST['enddate'];


            $query = "select * from student where class_id = '$class_id' and section = '$section' and roll_no = '$rollno'";
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





        else{

        //if class, section, start date and end date is selected  
        if(!empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']) && !empty($_POST['startdate']) && !empty($_POST['enddate']))
        {
            
            $class_id = $_POST['sclass'];
            $section = $_POST['ssection'];
            $rollno = $_POST['srollno'];

            $startdate = $_POST['startdate'];

            $enddate = $_POST['enddate'];


            $query = "select * from student where class_id = '$class_id' and section = '$section' order by roll_no asc";
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

            }else{

                echo "Query Failed";
            }

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
                                <!-- <th class="border-top-0">Sr #</th> -->
                                <th class="border-top-0">Roll No</th>
                                <th class="border-top-0">Student Name</th>
                                <th class="border-top-0" style="width:8% !important;">Class</th>
                                <th class="border-top-0" style="width:8% !important;">Section</th>
                                <th class="border-top-0" style="width:8% !important;">Start Date</th>
                                <th class="border-top-0" style="width:8% !important;">End Date </th>
                                <th class="border-top-0">Absents </th>
                                <th class="border-top-0">Leaves </th>
                                <th class="border-top-0">Presents </th>
                                <!-- <th class="border-top-0">Attendence Days</th> -->
                                <th class="border-top-0">Total Days</th>
                                <th class="border-top-0">Attendence Percentage (%)</th>
                            </tr>
                        </thead>
                        <tbody class="table-data">
                            

                    <?php
                            $count1 = 1;

                            while($row = mysqli_fetch_array($result))
                            {
                                //$id = $row['s_a_id'];

                    ?>
                            <tr>
                                <!-- <td><?php //echo $count1; ?></td> -->
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

                                <td>
                                <?php  
                                
                                    //$unixStartDate = strtotime($_POST['startdate']);

                                    $realStartDate = date('d-m-Y' , $unixStartDate); 
                                    echo $realStartDate;

                                ?>
                                </td>

                                <td>
                                <?php  
                                
                                    //$unixEndDate = strtotime($_POST['enddate']);

                                    $realEndDate = date('d-m-Y' , $unixEndDate); 
                                    echo $realEndDate;

                                ?>
                                </td>


    <?php
    
    $query2 = "select * from student_attendence where s_id = " . $row['s_id'] . " and date >= '$unixStartDate' and date <= '$unixEndDate' ";
    $result2 = mysqli_query($con, $query2);

    if($result2)
    {
        $totalAttendenceDays = mysqli_num_rows($result2);

        $totalDays = abs($unixStartDate - $unixEndDate)/60/60/24;

        // $query3 = "select * from student_attendence where s_id = " . $row['s_id'] . " and status = 'present' || status = 'leave' and date >= '$unixStartDate' and date <= '$unixEndDate' ";
        // $result3 = mysqli_query($con, $query3);

        $query4 = "select * from student_attendence where s_id = " . $row['s_id'] . " and status = 'leave' and date >= '$unixStartDate' and date <= '$unixEndDate' ";
        $result4 = mysqli_query($con, $query4);

        $query5 = "select * from student_attendence where s_id = " . $row['s_id'] . " and status = 'present' and date >= '$unixStartDate' and date <= '$unixEndDate' ";
        $result5 = mysqli_query($con, $query5);

        $query6 = "select * from student_attendence where s_id = " . $row['s_id'] . " and status = 'absent' and date >= '$unixStartDate' and date <= '$unixEndDate' ";
        $result6 = mysqli_query($con, $query6);

        if($result4)
        {
            $totalAbsentDays = mysqli_num_rows($result6);

            $totalLeaveDays = mysqli_num_rows($result4);

            $totalPresentDays = mysqli_num_rows($result5);

            $totalLeavePresentDays = $totalLeaveDays + $totalPresentDays;

            $attendencePercent = ($totalLeavePresentDays * 100) / $totalDays;

            $attendencePercent = ceil($attendencePercent);


        }

    }
    
    ?>


                                <td>
                                    <?php echo $totalAbsentDays; ?>   
                                </td>

                                <td>
                                    <?php echo $totalLeaveDays; ?>   
                                </td>

                                <td>
                                    <?php echo $totalPresentDays; ?>   
                                </td>
                                

                                <!-- <td>
                                    <?php //echo $totalAttendenceDays; ?>   
                                </td> -->

                                <td>
                                    <?php echo $totalDays; ?>   
                                </td>

                                <td>
                                   <strong> <?php echo $attendencePercent; ?> </strong>             
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
            echo "<h3 class='pt-5'> No Attendence Record Found !</h3>";
            echo "</div>";
        }

    }


?>                        
 