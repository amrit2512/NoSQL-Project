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
    $successMessage="";
    $ErrorMessage="*All Fields are Compulsory";
    $mobpat='/^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/';
    if(isset($_POST["res"])){
        header('Register.php');
    }
    if(isset($_POST["reg"])){
        $name=$_POST["name"];
        $email=$_POST["email"];
        $pass=$_POST["pass"];
        $cpass=$_POST["cpass"];
        $mob=$_POST["mob"];
        $dob=$_POST["DOB"];
        if(empty($name)||empty($email)||empty($pass)||empty($cpass)||empty($mob)||empty($dob)){
            $ErrorMessage="*All Fields are Compulsory";
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $ErrorMessage = "*Invalid email format";
        }else if($pass!=$cpass){
            $ErrorMessage="*Password and confirm password are different";
        }else if(!preg_match($mobpat,$mob)){
            $ErrorMessage="*Mobile number not valid";
        }else{
            $res=$col->count(['email'=>$email]);
            if($res>0){
                $successMessage="Email already registered.";
            }else{
                $data=[
                    'name' => $name,
                    'email'=> $email,
                    'password'=> $pass,
                    'mob'=> $mob,
                    'dob'=> $dob
                ];
                $res=$col->insertOne($data);
                if($res->getInsertedCount()>0){
                    $successMessage="Registration Success";
                    $ErrorMessage="";
                }
                else{
                    $successMessage="Registration Unsuccessfull";
                }
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
    <title>Register</title>
    <link rel="stylesheet" href="Register.css">
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
                <legend>Register</legend>
                <form method="POST" action="">
                    <span id="Success"><?php echo $successMessage?></span>
                    <div class="tooltip">
                        <input class="inp tooltip" type="text" placeholder="Name" name="name">
                        <span class="tooltiptext"> *Name </span>
                    </div>
                    <div class="tooltip">
                        <input class="inp tooltip" type="email" placeholder="E-Mail" name="email">
                        <span class="tooltiptext"> *Email </span>
                    </div>
                    <div class="tooltip">
                        <input class="inp tooltip" type="password" placeholder="Password" name="pass">
                        <span class="tooltiptext"> *Password </span>
                    </div>
                    <div class="tooltip">
                        <input class="inp tooltip" type="password" placeholder="Confirm Password" name="cpass">
                        <span class="tooltiptext"> *Should be same as the above Password </span>
                    </div>
                    <div class="tooltip">
                        <input class="inp tooltip" type="date" placeholder="Date of Birth" name="DOB">
                        <span class="tooltiptext"> *Date of Birth </span>
                    </div>
                    <div class="tooltip">
                        <input class="inp tooltip" type="text" placeholder="Mobile Number" name="mob">
                        <span class="tooltiptext"> *Mobile Number eg. "9457865478" or "+91-9457865478" </span>
                    </div>
                    <div id="inbox">
                        <input  type="submit" value="Register" name="reg">
                        <input  type="submit" value="Reset" name="res">
                    </div>
                    <span id="Error"><?php echo $ErrorMessage?></span>
                </form>
            </fieldset>
            <span id="text">Already Registered? <a href="Sign_In.php" id="link">Sign In</a></span>
        </div>
        <div id="box3">
            <?php
                include 'Footer.html';     
            ?>
        </div>
    </div>
</body>
</html>
