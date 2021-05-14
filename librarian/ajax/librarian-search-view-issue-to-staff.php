  
<?php

session_start();
include('../includes/config.php');

    //if no field is selected
    if(empty($_POST['cnic'] ))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Cnic !</h3>";
        echo "</div>";        
    }
    else
    {

        //if class and section is selected         
        if(!empty($_POST['cnic'] ))
        {

            $cnic = $_POST['cnic']; 
            $cnic = preg_replace('/[^0-9]/', '', $cnic);

            $query = "select * from staff where cnic = '$cnic' ";
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
                                <th class="border-top-0">Teacher <small> (CNIC) </small> </th>
                                <th class="border-top-0">Teacher Name</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-data">
                            

                    <?php
                            $count1 = 1;

                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['st_id'];
                    ?> 
                            <tr>
                                <td><?php echo $count1; ?></td>
                                <td><?php echo $row['cnic']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <a href="librarian-issue-to-staff.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm btn-action">Issue Book</a>
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
        echo "<h3 class='pt-5'> No Staff Member Record Found !</h3>";
        echo "</div>";

    }
}

?>                         