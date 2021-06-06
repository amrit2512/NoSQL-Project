<?php
    error_reporting(0);
    session_name("PHPSESSID");
    session_start();
    if(isset($_SESSION['Username'])){
        header('location: Home.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Scheduler</title>
    <link rel="stylesheet" href="Index.css">
</head>
<body>
    <div id="container">
        <div id="box1">
            <h1>Meeting Scheduler</h1>
            <h4>Using PHP and MongoDB Atlas</h4>
            <h6>Under:- Prof. Hari Kishan Kondaveeti</h6>
        </div>
        <div id="box2">
            <a href="Sign_In.php">
                <button class="btn" >Sign-In</button>
            </a>
            <a href="Register.php">
                <button class="btn">Register</button>
            </a>
        </div>
    </div>
</body>
</html>