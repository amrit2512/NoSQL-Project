<?php
    require 'vendor/autoload.php';
    error_reporting(0);
    session_name("PHPSESSID");
    session_start();
    if(!isset($_SESSION['Username'])){
        header('location: Sign_In.php');
        die();
    }
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col=$db->Users;
    $col1=$db->Meetings;
    $col2=$db->Requests;
    $email="";
    $Message="";
    if(isset($_POST["Fpass"])){
        header('Register.php');
    }
    if(isset($_POST["signin"])){
        $email=$_POST["email"];
        if(empty($email)){
            $Message = "*Enter the Email";
        }else if($email==$_SESSION['Email']){
            $Message = "*You can't send yourself a request";
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $Message = "*Invalid email format";
        }else{
            $res=$col->find(['email'=>$email])->toArray();
            if(sizeof($res)>0){
                $res2=$col2->find(['Meeting ID'=>$_GET['mid'],'Email'=>$email])->toArray();
                if(sizeof($res2)==0){
                    $res1=$col1->find(['Meeting ID'=>$_GET['mid']])->toArray();
                    $data=[
                        'Meeting ID'=>$_GET['mid'],
                        'Title'     =>$res1[0]['Title'],
                        'Start Time'=>$res1[0]['Start Time'],
                        'End Time'  =>$res1[0]['End Time'],
                        'Email'     =>$email,
                        'Name'      =>$_SESSION['Username']
                    ];
                    $res3=$col2->insertOne($data);
                    if($res3->getInsertedCount()>0){
                        $Message="Request Sent";
                    }
                    else{
                        $Message="Request Not Sent";
                    }
                }else{
                    $Message="Request Already Sent";
                }
            }else{
                $Message="Not a registered user";
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
                include 'Header.php';     
            ?>
        </div>
        <div id="box2">
            <fieldset id="a1">
                <legend>Sign In</legend>
                <form method="POST" action="">
                    <span id="Success"><?php echo $Message?></span>
                    <div class="tooltip">
                        <input class="inp" type="email" placeholder="E-Mail" name="email">
                        <span class="tooltiptext">*Guests E-Mail </span>
                    </div>
                    <div id="inbox">
                        <input  id="btn" type="submit" value="Add Participant" name="signin">
                    </div>
                </form>
            </fieldset>
        </div>
        <div id="box3">
            <?php
                include 'Footer.html';     
            ?>
        </div>
    </div>
</body>
</html>