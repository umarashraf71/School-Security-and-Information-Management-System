  
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

            $query = "select * from library_books where book_no like '%$search%' || book_name like '%$search%' || author_name like '%$search%' order by date desc ";
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

            $query = "select * from library_books where date = '$date' and CONCAT(`book_no`, `book_name`, `author_name` ) LIKE '%".$search."%' ";
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

            $query = "select * from library_books where date = '$date' ";
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
                                <th class="border-top-0">Author</th>
                                <th class="border-top-0">Edition</th>
                                <th class="border-top-0">Quantity</th>
                                <th class="border-top-0">Price <small>(Rs)</small></th>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-data">
                            

                    <?php
                            $count1 = 1;

                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['book_id'];

                    ?>
                            <tr>
                                <td><?php echo $count1; ?></td>
                                <td><?php echo $row['book_no']; ?></td>
                                <td><?php echo $row['book_name']; ?></td>
                                <td><?php echo $row['author_name']; ?></td>
                                <td><?php echo $row['edition']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['book_price']; ?></td>
                                <td><?php echo date('d-m-Y', $row['date'] );  ?></td>
                                <td>
                                    <a href="librarian-edit-book.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm btn-action mr-1">Edit</a>
                                    <a  onClick="return confirm('Are you sure you want to delete ?')" 
                                        href="librarian-view-edit-books.php?deleteId=<?php echo $id; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
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
        echo "<h3 class='pt-5'> No Book Record Found !</h3>";
        echo "</div>";

    }
}

?>                        