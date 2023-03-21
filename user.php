<?php
require('db.inc.php');
session_start();
if((!isset($_SESSION['ROLE']))||($_SESSION['ROLE']!=2)){
  header('location:index.php');
  die();
}
$name='';
$department='';
$from='';
$to='';
$reason='';
if(isset($_POST['submit'])){
  $name=mysqli_real_escape_string($con,$_POST['name']);
  $department=mysqli_real_escape_string($con,$_POST['department']);
  $from=mysqli_real_escape_string($con,$_POST['from']);
  $to=mysqli_real_escape_string($con,$_POST['to']);
  $reason=mysqli_real_escape_string($con,$_POST['reason']);
  $reg=$_SESSION['USERNAME'];
  $sql= "INSERT INTO leave_type(Student,Reg_no,Department,From_date,To_date,Reason,leave_status) VALUES('$name','$reg','$department','$from','$to','$reason',1)";
  mysqli_query($con,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Leave</title>
    <link rel="shortcut icon" href="Images/logo.jpg">
    <link rel="stylesheet" href="style.css">
    <!-- Sweet Alert CDN -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
      body{
          background-image: url("Images/login.jpg");
          width: 100%;
          background-position: center;
          background-size: cover;
          height: 150vh;
      }
  </style>
</head>
<body>
    <div class="head">
        <img src="Images/College name.jpg">
    </div>
    <ul id="nav">
      <li><a class="active" href="user.php">Apply for Leave</a></li>
      <li><a href="status.php">Application Status</a></li>
      <li><a href="logout.php">Log Out</a></li>
  </ul>
  <div class="application">
    <h2>Leave Form</h2>
          <form class="leaveform" method="post">
          <label>Full Name</label>
          <input type="text" name="name" required>
          <br>
          <label>Department</label>
          <select name="department" required>
            <option value="">Select Department</option>
            <option value="CSE">CSE Department</option>
            <option value="IT">IT Department</option>
            <option value="ADS">ADS Department</option>
            <option value="AML">AML Department</option>
            <option value="Civil">Civil Department</option>
            <option value="Mechanical">Mechanical Department</option>
            <option value="EEE"> EEE Department</option>
          </select>
          <br>
          <label>From</label>
          <input type="date" name="from" required>
          <br>
          <label>To</label>
          <input type="date" name="to" required>
          <br>
          <label>Reason</label>
          <textarea name="reason" rows="5" cols="7" required></textarea>
          <br>
          <button type="submit" name="submit">Submit</button>
          <button type="reset">Refresh</button>
        </form>
  </div>
  <?php if($sql){
    ?>
    <script>
      swal({
        title: "Done",
        text: "Leave Applied Successfully!",
        icon: "success",
        button: "OK",
      });
    </script>
    <?php
  }
  ?>
</body>
</html>