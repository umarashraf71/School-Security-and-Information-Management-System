   
<?php

session_start();
include('../includes/config.php');
date_default_timezone_set("Asia/Karachi");


    //if no field is selected
    if(empty($_POST['xdate'] ) && empty($_POST['expense'] ))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";        
    }
    //if expense field is selected
    else if(empty($_POST['xdate'] ) && !empty($_POST['expense'] ))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";        
    }
    else
    {

        //if date and expense is selected         
        if(!empty($_POST['xdate'] ) && !empty($_POST['expense']))
        {
 
            $date = strtotime($_POST['xdate']); 
            $expense = $_POST['expense'];

            $query = "select * from expense where date = '$date' and name like '%".$expense."%' ";
            $result = mysqli_query($con, $query);

            if($result)
            {
                $count = mysqli_num_rows($result);

            }else{

                echo "Query Failed ";
            }

        }

        //if date is selected         
        if(!empty($_POST['xdate'] ) && empty($_POST['expense']))
        {
 
            $date = strtotime($_POST['xdate']); 

            $query = "select * from expense where date = '$date' ";
            $result = mysqli_query($con, $query);

            if($result)
            {
                $count = mysqli_num_rows($result);

            }else{

                echo "Query Failed ";
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
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Expense Name</th>
                                <th class="border-top-0">Expense Type</th>
                                <th class="border-top-0">Expense Amount <small>(Rs)</small></th>
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
                                <td><?php echo date('d-m-Y' , $row['date']); ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['type']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td>
                                    <a href="accountant-view-edit-expenses.php?deleteId=<?php echo $row['x_id']; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
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
        echo "<h3 class='pt-5'> No Expenses Found !</h3>";
        echo "</div>";

    }
}

?>                        