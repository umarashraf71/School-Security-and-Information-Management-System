<?php
session_start();
ob_start();
if ((isset($_SESSION['id'])) && (isset($_SESSION['uname'])) ){
	//welcome 
	// echo $_SESSION['idnumber'];
  $role = $_SESSION['id'];
  $role1 = $_SESSION['uname'];
}else{
	header('Location:logout.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>TIME ATTENDANCE</title>
  <?php
    $page = $_SERVER['PHP_SELF'];
    $sec = "10";
  ?>
  <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style type="text/css">
.pull-right .dropdown-menu:after {
    left: auto;
    right: 13px;
}
.pull-right .dropdown-menu {
    left: auto;
    right: 0;
}</style>
</head>
<body >
<!--navbar -->
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">TIME ATTENDANCE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Users.php">System Users</a>
        </li>
     
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <li class="nav-item dropdown" >
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo "lOGGED IN AS: ".strtoupper($role1);?>
        </a>
        <div class="dropdown-menu pull-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="./logout.php">Logout</a>
        </div>
      </li>
    </div>
  </nav>
</header>
<!--navbar -->
  <div class="container">
    <?php
      include "zklibrary.php";
      include "dbConnection.php";
      include_once "SmsController.php";

      $zk = new ZKLibrary('119.160.100.238', 4370, 'TCP');
      $zk->connect();
      $zk->disableDevice();

      $users = $zk->getUser(); 
      $attendace = $zk->getAttendance();
      ?>
      <table width="100%" border="1" class="table table-hover" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
      <thead>
        <tr>
          <td width="25">No</td>
          <td>UID</td>
          <td>ID</td>
          <td>Name</td>
          <td>Role</td>
          <td>Password</td>
        </tr>
      </thead>

      <tbody>
      <?php
      $no = 0;
      foreach($users as $key=>$user)
      {
        $no++;
      ?>

        <tr>
          <td align="right"><?php echo $no;?></td>
          <td><?php echo $key;?></td>
          <td><?php echo $user[0];?></td>
          <td><?php echo $user[1];?></td>
          <td><?php echo $user[2];?></td>
          <td><?php echo $user[3];?></td>
        </tr>

      <?php
      }
      ?>

      </tbody>
      </table>
      <br /><br />
      <table  width="100%" border="1" cellspacing="0" class="table table-striped" cellpadding="0" style="border-collapse:collapse;">
      <thead>
        <tr>
          <td width="25">No</td>
          <td>UID</td>
          <td>ID</td>
          <td>State</td>
          <td>Date/Time</td>
        </tr>
      </thead>

      <tbody>
      <?php
      $no = 0;
      foreach($attendace as $key=>$at)
      {
        $no++;
        $uid = $at[0];
        $query = "SELECT * FROM attendance WHERE uid=$uid";
        $sql_result = mysqli_query($conn, $query);
        $result =mysqli_fetch_assoc($sql_result);

        $s_id = mysqli_insert_id($conn);
        
        if(count($result)==0)
        {
          //insert to db
          $saveQuery = "INSERT INTO student(ZKTECO_ID, MESSAGE_STATUS)
          VALUES('".$at[1]."','".$at[3]."','PENDING','".$at[0]."') where s_id = '$s_id'";

          $connz = mysqli_query($conn,$saveQuery);
          if($connz)
          {
            echo "Saved";
          }else{
            echo "not saved";
          }
        }
      ?>

        <tr>
          <td align="right"><?php echo $no;?></td>
          <td><?php echo $at[0];?> </td>
          <td><?php echo $at[1];?> ID</td>
          <td><?php echo $at[2];?></td>
          <td><?php echo $at[3];?>   TIME</td>
        </tr>

      <?php
      }
      ?>

      </tbody>
      </table>
      <?php

      $zk->enableDevice();
      $zk->disconnect();
      ?>

      <?php
     //  include 'dbConnection.php';
      // $id='';
      $sql = " SELECT student.ID,student.FULLNAME,student.REGISTRATION_NUMBER,
      attendance.TIME,attendance.MESSAGE_STATUS,attendance.UID,
      guardian.PHONE_NUMBER,guardian.FULLNAMES 
      FROM student 
      JOIN guardian ON student.ID = guardian.STUDENT_ID 
      JOIN attendance ON attendance.ZKTECO_ID = student.ZKTECO_ID
      WHERE    attendance.MESSAGE_STATUS='PENDING' ";
                  
      $mysqli = new mysqli("localhost", "root", "", "sims"); 
        
      if ($mysqli == false) { 
          die("ERROR: Could not connect. " 
                                .$mysqli->connect_error); 
      } 
        
      if ($res = $mysqli->query($sql)) { 
          if ($res->num_rows > 0) { 
              echo "<table BORDER='2'>"; 
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
                  $student = $row['FULLNAME'];
                  $studenta = $row['FULLNAMES'];
                  $uid=$row['UID'];
               
                  $phone = $row['PHONE_NUMBER'];
                  $regnum= $row['REGISTRATION_NUMBER'];
                 
                  $message =( "DEAR  ".$studenta." , ".$student." Registration Number ".$regnum." arrived in school at ->".$row['TIME']);
              
              
                        } 
              echo "</table>"; 
              $res->free();
              $initiator = new SmsController($phone,$message);

              $status = $initiator->sendMessage();
              if($status){
                $sqlQ = "UPDATE attendance SET MESSAGE_STATUS='SENT' WHERE UID=$uid";
                $result = mysqli_query($conn, $sqlQ);
              }else{
                echo  "failed to sent";
              }
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
  </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
</body>
</html>