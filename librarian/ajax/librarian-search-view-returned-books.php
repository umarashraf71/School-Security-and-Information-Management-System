  
<?php

session_start();
include('../includes/config.php');
date_default_timezone_set("Asia/Karachi");

$status = "returned";

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

            $query = "select * from library_issue_books where status = '$status' and CONCAT(`book_no`, `book_name`) LIKE '%".$search."%' order by return_date desc ";
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

            $query = "select * from library_issue_books where status = '$status' and return_date = '$date' and CONCAT(`book_no`, `book_name`) LIKE '%".$search."%' ";
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

            $query = "select * from library_issue_books where return_date = '$date' and status = '$status' ";
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
                                <th class="border-top-0">Book No</th>
                                <th class="border-top-0">Book Name</th>
                                <th class="border-top-0">Receiver Name</th>
                                <th class="border-top-0">Receiver Type</th>
                                <th style="width:10% !important" class="border-top-0">Issue Date</th>
                                <th style="width:10% !important" class="border-top-0">Return Date</th>
                                <th class="border-top-0">Status</th>
                                <th style="width:17% !important" class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-data">
                            

                    <?php
                            $count1 = 1;

                            while($row = mysqli_fetch_array($result))
                            {
                                $b_id = $row['l_ib_id']; 

                    ?>
                            <tr>
                                <td><?php echo $count1; ?></td>

                                
                        <?php   //Start receiver type Student

                            if ($row['type'] == 'student') 
                            {

                                $s_id = $row['s_id'];

                                $query1 = "select * from student where s_id = '$s_id' ";
                                $result1 = mysqli_query($con, $query1);

                                if($result1)
                                {
                                    $row1 = mysqli_fetch_array($result1);
                                }
                                
                        ?>
 
                                        <td><?php echo $row['book_no']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td><?php echo ucfirst($row1['name']); ?></td>
                                        <td><?php echo ucfirst($row['type']); ?></td>
                                        <td><?php echo date('d-m-Y', $row['issue_date'] );  ?></td>
                                        <td><?php echo date('d-m-Y', $row['return_date'] );  ?></td>
                                        <td><?php echo ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="librarian-view-book-details.php?s_id=<?php echo $s_id; ?>&b_id=<?php echo $b_id; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                            <a onClick="return confirm('Are you sure you want to delete ?')" href="librarian-view-returned-books.php?deleteId=<?php echo $b_id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
                                        </td>

                        <?php
                            } //End receiver type Student
                        ?>                



                        <?php   //Start receiver type Teacher

                            if ($row['type'] == 'teacher') 
                            {

                                $t_id = $row['t_id'];

                                $query2 = "select * from teacher where t_id = '$t_id' ";
                                $result2 = mysqli_query($con, $query2);

                                if($result2)
                                {
                                    $row2 = mysqli_fetch_array($result2);
                                }
                                
                        ?>
 
                                        <td><?php echo $row['book_no']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td><?php echo ucfirst($row2['name']); ?></td>
                                        <td><?php echo ucfirst($row['type']); ?></td>
                                        <td><?php echo date('d-m-Y', $row['issue_date'] );  ?></td>
                                        <td><?php echo date('d-m-Y', $row['return_date'] );  ?></td>
                                        <td><?php echo ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="librarian-view-book-details.php?t_id=<?php echo $t_id; ?>&b_id=<?php echo $b_id; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                            <a onClick="return confirm('Are you sure you want to delete ?')" href="librarian-view-returned-books.php?deleteId=<?php echo $b_id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
                                        </td>

                        <?php
                            } //End Receiver type Teacher 
                        ?>                



                        <?php   //Start receiver type Staff

                            if ($row['type'] == 'staff') 
                            {

                                $st_id = $row['st_id'];

                                $query3 = "select * from staff where st_id = '$st_id' ";
                                $result3 = mysqli_query($con, $query3);

                                if($result3)
                                {
                                    $row3 = mysqli_fetch_array($result3);
                                }
                                
                        ?>
 
                                        <td><?php echo $row['book_no']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td><?php echo ucfirst($row3['name']); ?></td>
                                        <td><?php echo ucfirst($row['type']); ?></td>
                                        <td><?php echo date('d-m-Y', $row['issue_date'] );  ?></td>
                                        <td><?php echo date('d-m-Y', $row['return_date'] );  ?></td>
                                        <td><?php echo ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="librarian-view-book-details.php?st_id=<?php echo $st_id; ?>&b_id=<?php echo $b_id; ?>" class="btn btn-success btn-sm btn-action mr-1">View</a>
                                            <a onClick="return confirm('Are you sure you want to delete ?')" href="librarian-view-returned-books.php?deleteId=<?php echo $b_id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
                                        </td>

                        <?php
                            } //End Receiver type Staff 
                        ?>                



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
        echo "<h3 class='pt-5'> No Book Record Found !</h3>";
        echo "</div>";

    }
}

?>                         