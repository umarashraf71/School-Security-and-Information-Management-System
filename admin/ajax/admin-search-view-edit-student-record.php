
<?php

session_start();
include('../includes/config.php');

    //if no field is selected
    if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";
        
    }
    //if only section and roll no is selected
    else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['srollno']))
    {

        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Kindly Select Class !</h3>";
        echo "</div>";

    }
    //if only section is selected
    else if(empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']))
    {

        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Kindly Select Class or Roll No !</h3>";
        echo "</div>";

    }
    //if only roll no is selected
    else if(empty($_POST['sclass'] ) && empty($_POST['ssection']) && !empty($_POST['srollno']))
    {

        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Kindly Select Class and Section !</h3>";
        echo "</div>";

    }
    else
    {

        //if class is selected we show all students with respect to different sections        
        if(!empty($_POST['sclass'] ) && empty($_POST['ssection']) && empty($_POST['srollno']))
        {
            // echo "<div class='col-md-12 text-center mt-5'>";
            // echo "<h3 class='pt-5'> No Student Record Exists !</h3>";
            // echo "</div>";
            
            $class_id = $_POST['sclass'];

            $query = "select * from student where class_id = '$class_id' ";
            $result = mysqli_query($con, $query);

            if($result)
            {
                $count = mysqli_num_rows($result);

            }else{

                echo "Query Failed";
            }

        }
 

        //if class and section is selected 
        if(!empty($_POST['sclass'] ) && !empty($_POST['ssection']) && empty($_POST['srollno']))
        {
            
            $class_id = $_POST['sclass'];
            $ssection = $_POST['ssection'];

            $query = "select * from student where class_id = '$class_id' and section = '$ssection'";
            $result = mysqli_query($con, $query);

            if($result)
            {
                $count = mysqli_num_rows($result);

            }else{

                echo "Query Failed";
            }

        }



        //if class and section and roll no is selected
        if(!empty($_POST['sclass'] ) && !empty($_POST['ssection']) && !empty($_POST['srollno']))
        {
            
            $class_id = $_POST['sclass'];
            $ssection = $_POST['ssection'];
            $srollno = $_POST['srollno'];

            $query = "select * from student where class_id = '$class_id' and section = '$ssection' and roll_no = '$srollno' ";
            $result = mysqli_query($con, $query);

            if($result)
            {
                $count = mysqli_num_rows($result);

            }else{

                echo "Query Failed";
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
                                <th class="border-top-0">Father Name</th>
                                <th class="border-top-0">Class</th>
                                <th class="border-top-0">Section</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-data">
                            

                    <?php
                            $count1 = 1;

                            while($row = mysqli_fetch_array($result))
                            {

                    ?>
                            <tr>
                                <td><?php echo $count1; ?></td>
                                <td><?php echo $row['roll_no']; ?></td>
                                <td><?php echo ucfirst($row['name']); ?></td>
                                <td><?php echo ucfirst($row['father_name']); ?></td>
                                
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
                                    <a href="admin-view-student-record.php?id=<?php echo $row['s_id']; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                    <a href="admin-edit-student-record.php?id=<?php echo $row['s_id']; ?>" class="btn btn-primary btn-sm btn-action mr-1">Edit</a>
                                    <a onClick="return confirm('Are you sure you want to delete ?')" 
                                        href="admin-view-edit-student-record.php?deleteId=<?php echo $row['s_id']; ?>" class="btn btn-danger btn-sm btn-action" onClick="return confirm('Are you sure you want to Delete?')">Delete</a>
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

        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> No Student Record Found !</h3>";
        echo "</div>";

    }
}

?>                        