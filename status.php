<?php
require('db.inc.php');
session_start();
if((!isset($_SESSION['ROLE']))||($_SESSION['ROLE']!=2)){
  header('location:index.php');
  die();
}
$reg=$_SESSION['USERNAME'];
$re=mysqli_query($con,"select * from leave_type where Reg_no='$reg'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Status</title>
    <link rel="shortcut icon" href="Images/logo.jpg">
    <link rel="stylesheet" href="style.css">
    <style>
      body{
          background-image: url("Images/login.jpg");
          width: 100%;
          background-position: center;
          background-size: cover;
          height: 90vh;
      }
  </style>
</head>
<body>
    <div class="head">
        <img src="Images/College name.jpg">
    </div>
    <ul id="nav">
      <li><a href="user.php">Apply for Leave</a></li>
      <li><a class="active" href="status.php">Application Status</a></li>
      <li><a href="logout.php">Log Out</a></li>
  </ul>
<table>
  <tr>
    <th width="20%">Student Name</th>
    <th width="20%">Department</th>
    <th width="10%">From</th>
    <th width="10%">To</th>
    <th width="30%">Reason</th>
    <th width="10%">Status</th>
  </tr>
  <?php 
  $i=1;
  while($row=mysqli_fetch_assoc($re)){?>
  <tr>
    <td><?php echo $row['Student']?> </td>
    <td><?php echo $row['Department']?> </td>
    <td><?php echo $row['From_date']?> </td>
    <td><?php echo $row['To_date']?> </td>
    <td><?php echo $row['Reason']?> </td>
    <td><?php
    if($row['leave_status']==1){
      echo "Applied";
    }
    if($row['leave_status']==2){
      echo "Approved";
    }
    if($row['leave_status']==3){
      echo "Rejected";
    }
  ?>
  </td>
  </tr>
  <?php 
 $i++;
  }
   ?>
  </table>
</body>
</html>
