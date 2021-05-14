<?php
// include 'dbConnection.php';
$id='2';
$sql = " SELECT student.ID,student.FULLNAMES,student.REGISTRATION_NUMBER,
            attendance.TIME,attendance.MESSAGE_STATUS,
            guardian.PHONE_NUMBER,guardian.FULLNAMES 
            FROM student 
            JOIN guardian ON student.ID = guardian.STUDENT_ID 
            JOIN attendance ON guardian.STUDENT_ID = attendance.ZKTECO_ID 
            WHERE student.ID ='$id' and attendance.MESSAGE_STATUS='PENDING' ";
            
$mysqli = new mysqli("localhost", "root", "", "attendtracks"); 
  
if ($mysqli == false) { 
    die("ERROR: Could not connect. " 
                          .$mysqli->connect_error); 
} 
  
if ($res = $mysqli->query($sql)) { 
    if ($res->num_rows > 0) { 
        echo "<table>"; 
        echo "<tr>"; 
        echo "<th>Firstname</th>"; 
        echo "<th>Lastname</th>"; 
        echo "<th>Age</th>"; 
        echo "</tr>"; 
        while ($row = $res->fetch_array())  
        { 
            echo "<tr>"; 
            echo "<td>".$row['FULLNAMES']."</td>"; 
            echo "<td>".$row['TIME']."</td>"; 
            echo "<td>".$row['PHONE_NUMBER']."</td>"; 
            echo "</tr>"; 
        } 
        echo "</table>"; 
        $res->free(); 
    } 
    else { 
        echo "No matching records are found."; 
    } 
} 
else { 
    echo "ERROR: Could not able to execute $sql. " 
                                             .$mysqli->error; 
} 
$mysqli->close(); 
?> 