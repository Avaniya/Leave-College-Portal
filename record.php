<?php
require('db.inc.php');
session_start();
if((!isset($_SESSION['ROLE']))||($_SESSION['ROLE']!=1)){
  header('location:index.php');
  die();
}
$res=mysqli_query($con,"select * from leave_type");
$sname='';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin!</title>
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
      <li><a href="Admin.php">Leave Applications</a></li>
      <li><a class="active" href="record.php">Approved Leaves</a></li>
      <li><a href="logout.php">Log Out</a></li>
  </ul>

  <!-- Search Bar -->
  <div>
    <form class="search" method="GET">
    <input type="text" placeholder="Enter Full Name" name="sname"></input>
    <button type="submit">Search</button>
    </form>
  </div>
  <?php
  if(isset($_GET['sname'])){
    $sname=mysqli_real_escape_string($con,$_GET['sname']);
    $resultarr=mysqli_query($con,"select * from leave_type where Student='$sname' and leave_status='2'"); ?>
    <h3 class="search_name">Search results:</h3>
    <?php
    while($result=mysqli_fetch_assoc($resultarr)){?>
    <table>
    <tr>
      <td><?php echo $result['Student']?> </td>
      <td><?php echo $result['Department']?> </td>
      <td><?php echo $result['From_date']?> </td>
      <td><?php echo $result['To_date']?> </td>
      <td><?php echo $result['Reason']?> </td>
    </tr>
    <?php
    }
  }
  ?>
  </table>
  <table>
  <tr>
    <th width="20%">Student Name</th>
    <th width="20%">Department</th>
    <th width="15%">From</th>
    <th width="15%">To</th>
    <th width="30%">Reason</th>
    </tr>
  <?php 
  $i=1;
  while($row=mysqli_fetch_assoc($res)){
    if($row['leave_status']==2){?>
    <tr>
      <td><?php echo $row['Student']?> </td>
      <td><?php echo $row['Department']?> </td>
      <td><?php echo $row['From_date']?> </td>
      <td><?php echo $row['To_date']?> </td>
      <td><?php echo $row['Reason']?> </td>
    </tr>
     <?php 
    }
    $i++;
  }
  ?>
</table>
</body>
</html>