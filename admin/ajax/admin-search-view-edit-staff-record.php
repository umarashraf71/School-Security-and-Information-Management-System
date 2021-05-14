<?php  

session_start();
include('../includes/config.php');

?>

<?php


if(!empty($_POST['search']))
{
    $search = $_POST['search'];

    $query = "select * from staff where name like '%$search%' || contact like '%$search%' || cnic like '%$search%' || type like '%$search%'  ";
    $result = mysqli_query($con,$query);

    if($result)
    {
        $count = mysqli_num_rows($result);
        
    }

    if($count > 0)
    {
        
        $row1 = mysqli_fetch_array($result);
        $adminType = $row1['type'];

        if($adminType != 'admin')
        {

?>     

  
    <div class="col-md-12 mt-4 edit-student-table">
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
                            <th class="border-top-0">Member <small> ( CNIC ) </small></th>
                            <th class="border-top-0">Member Name</th>
                            <th class="border-top-0">Contact No</th>
                            <th class="border-top-0">Type</th>
                            <th class="border-top-0">Hiring Date</th>
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
                            <td><?php echo $row['cnic']; ?></td>
                            <td><?php echo ucfirst($row['name']); ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo ucfirst($row['type']); ?></td>
                            <td><?php echo date('d-m-Y', $row['hiring_date'] );  ?></td>
                            <td>
                                <a href="admin-view-staff-record.php?id=<?php echo $row['st_id']; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                                                <a href="admin-edit-staff-record.php?id=<?php echo $row['st_id']; ?>" class="btn btn-primary btn-sm btn-action mr-1">Edit</a>
                                <a onClick="return confirm('Are you sure you want to delete ?')" 
                                    href="admin-view-edit-staff-record.php?deleteId=<?php echo $row['st_id']; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>

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
            echo "<h3 class='pt-5'> No Staff Record Found !</h3>";
            echo "</div>";            
        }              


    }
    else
    {
        echo "<div class='col-md-12 text-center mt-5'>";
        echo "<h3 class='pt-5'> No Staff Record Found !</h3>";
        echo "</div>";        
    }

}
else
{
    echo "<div class='col-md-12 text-center mt-5'>";
    echo "<h3 class='pt-5'> Kindly Enter Some Keyword to Search !</h3>";
    echo "</div>";
}


?>