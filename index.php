<?php
require('db.inc.php');
$msg="";
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $res=mysqli_query($con,"select * from user where username='$username' and password='$password'");
    $count=mysqli_num_rows($res);
    if($count>0){
        $row=mysqli_fetch_assoc($res);
        $_SESSION['ROLE']=$row['role'];
        $_SESSION['USERNAME']=$row['username'];
        $_SESSION['PASSWORD']=$row['password'];
        if($row['role']==1){
            header('location:Admin.php');
            die();
        }
        if($row['role']==2){
            header('location:user.php');
            die();
        }
    }
    else{
        $msg="Please enter correct login credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJCE Leave Application portal</title>
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
    <!-- Header -->
    <div class="head">
        <img src="Images/College name.jpg">
    </div>

    <!-- Login form -->
    <div class="login">
        <span style="font-family: Georgia, 'Times New Roman', Times, serif;font-size: 30px;color: #000;">LOG IN</span>
        <hr>
    <form method="post">
        <span>Reg. No.</span><br>
        <input type="text" name="username" required><br>
        <br>
        <span>Password</span><br>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button><br>
    </form>
    <div  style="color: red; font-size:15px; margin-top:10px;"><?php echo $msg ?></div>
    </div>
    
</body>
</html>