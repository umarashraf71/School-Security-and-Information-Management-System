   
<?php

session_start();
include('../includes/config.php');
date_default_timezone_set("Asia/Karachi");

    //if no field is selected
    if(empty($_POST['search'] ) && empty($_POST['sdate'] ))
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> Invalid Selection !</h3>";
        echo "</div>";        
    }
    else
    {

        //if search is selected         
        if(!empty($_POST['search'] ) && empty($_POST['date'] ))
        {

            $search = $_POST['search']; 

            $query = "select * from lab where name like '%$search%' || description like '%$search%' order by date desc ";
            $result = mysqli_query($con, $query);

            if($result)
            {
                $count = mysqli_num_rows($result);

            }else{

                echo "Query Failed";
            }

        }

        //if search and date is selected         
        if(!empty($_POST['search'] ) && !empty($_POST['sdate'] ))
        {

            $search = $_POST['search']; 
            $date = strtotime($_POST['sdate']); 

            $query = "select * from lab where date = '$date' and CONCAT(`name`, `description`) LIKE '%".$search."%' ";
            $result = mysqli_query($con, $query);

            if($result)
            {
                $count = mysqli_num_rows($result);

            }else{

                echo "Query Failed";
            }

        }

         //if date is selected         
        if( !empty($_POST['sdate'] ) && empty($_POST['search'] ))
        {

            $date = strtotime($_POST['sdate']); 

            $query = "select * from lab where date = '$date' ";
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
                                <th class="border-top-0">Asset / Material Name</th>
                                <th class="border-top-0">Quantity</th>
                                <th class="border-top-0">Price</th>
                                <th class="border-top-0">Description</th>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-data">
                            

                    <?php
                            $count1 = 1;

                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['lab_id'];

                    ?>
                            <tr>
                                <td><?php echo $count1 ?></td>
                                <td><?php echo ucfirst($row['name']); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo date('d-m-Y', $row['date'] );  ?></td>
                                <td>
                                    <a href="labhead-edit-lab-assets.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm btn-action mr-1">Edit</a>
                                    <a  onClick="return confirm('Are you sure you want to delete ?')" 
                                        href="labhead-view-edit-lab-assets.php?deleteId=<?php echo $id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
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
        echo "<h3 class='pt-5'> No Lab Asset Record Found !</h3>";
        echo "</div>";

    }
}

?>                        