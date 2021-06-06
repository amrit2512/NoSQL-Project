<?php
    require 'vendor/autoload.php';
    error_reporting(0);
    session_name("PHPSESSID");
    session_start();
    if(isset($_SESSION['Username'])){
        header('location: Home.php');
        die();
    }
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col=$db->Users;
    $name=$email=$pass=$cpass=$mob=$dob="";
    $Message="";
    $mobpat='/^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/';
    if(isset($_POST["Fpass"])){
        header('Register.php');
    }
    if(isset($_POST["signin"])){
        $email=$_POST["email"];
        $pass=$_POST["pass"];
        if(empty($email)||empty($pass)){
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $Message = "*Invalid email format";
        }else{
            $res=$col->find(['email'=>$email,'password'=>$pass])->toArray();
            if(sizeof($res)>0){
                $_SESSION['Username']=$res[0]['name'];
                $_SESSION['Email']=$res[0]['email'];
                header('location: Home.php');
                die();
                $Message="Credential Matched";
            }else{
                $Message="Credentials not Matched".$res[0]['name'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign_In</title>
    <link rel="stylesheet" href="Sign_In1.css">
</head>
<body>
    <div id="container">
        <div id="box1">
            <?php
                include 'Header1.php';     
            ?>
        </div>
        <div id="box2">
            <fieldset id="a1">
                <legend>Sign In</legend>
                <form method="POST" action="">
                    <span id="Success"><?php echo $Message?></span>
                    <div class="tooltip">
                        <input class="inp" type="email" placeholder="E-Mail" name="email">
                        <span class="tooltiptext"> E-Mail </span>
                    </div>
                    <div class="tooltip">
                        <input class="inp" type="password" placeholder="Password" name="pass">
                        <span class="tooltiptext"> Password </span>
                    </div>
                    <div id="inbox">
                        <input  id="btn" type="submit" value="Sign In" name="signin">
                        <input  id="btn" type="submit" value="Forgot Password?" name="Fpass">
                    </div>
                </form>
            </fieldset>
            <span id="text">Not Yet Registered? <a href="Register.php" id="link">Register</a></span>
        </div>
        <div id="box3">
            <?php
                include 'Footer.html';     
            ?>
        </div>
    </div>
</body>
</html>