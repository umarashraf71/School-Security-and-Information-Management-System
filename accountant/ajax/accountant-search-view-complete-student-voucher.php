<?php

session_start();
include('../includes/config.php');
date_default_timezone_set("Asia/Karachi");




$errorFlag = 0;
$count = 0;


    //if no field is selected
    if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']) && empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }
    //if class field is selected
    else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']) && empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if section field is selected
    else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']) && empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if roll_no field is selected
    else if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if date & class field is selected
    else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']) && !empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if date & section field is selected
    else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']) && !empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if date & roll field is selected
    else if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && !empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if class & section field is selected
    else if(!empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']) && empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if date & roll $class field is selected
    else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && !empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if date & roll $section field is selected
    else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['srollno']) && !empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if class & roll $section field is selected
    else if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']) && empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    //if section & roll $section field is selected
    else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['srollno']) && empty($_POST['sdate']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }

    else
    {

        //if class, section and date is selected         
        if(!empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['sdate']) && empty($_POST['srollno']))
        {
            // echo "<div class='col-md-12 text-center mt-5'>";
            // echo "<h3 class='pt-5'> No Student Record Exists !</h3>";
            // echo "</div>";
            
            $class_id = $_POST['sclass'];
            $section = $_POST['ssection'];
            $date = strtotime($_POST['sdate']);

            $query = "select * from student_voucher where class = '$class_id' and section = '$section' and issue_date = '$date' order by issue_date desc";
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

        if(!empty($_POST['sdate']) && !empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['srollno']))
        {
            
            $class_id = $_POST['sclass'];
            $section = $_POST['ssection']; 
            $date = strtotime($_POST['sdate']);
            $srollno = $_POST['srollno'];

            $query = "select * from student_voucher where class = '$class_id' and section = '$section' and issue_date = '$date' and roll_no = '$srollno' order by issue_date desc";
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

        //if date field is selected
        else if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']) && !empty($_POST['sdate']))
        {

            $date = strtotime($_POST['sdate']);

            $query = "select * from student_voucher where issue_date = '$date' order by issue_date desc";
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
                            $count1 = 1;

                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['s_v_id'];

                    ?>
                            <tr>
                                <td><?php echo $count1; ?></td>
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
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <a href="accountant-view-student-voucher.php?id=<?php echo $id ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                    <a  onClick="return confirm('Are you sure you want to complete this Voucher !')" 
                                        href="accountant-view-complete-student-voucher.php?completeId=<?php echo $id ?>" class="btn btn-primary btn-sm btn-action">Complete</a>
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
            echo "<h3 class='pt-5'> No Fee Voucher Found !</h3>";
            echo "</div>";
        }

    }


?>                        

