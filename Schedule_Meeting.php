<?php
    require 'vendor/autoload.php';
    session_start();
    error_reporting(0);
    if(!isset($_SESSION['Username'])){
        header('location: Sign_In.php');
        die();
    }
    $title=$stime=$etime="";
    $success=$failed="";
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col=$db->Meetings;
    $col1=$db->Participants;
    if(isset($_POST['cmeet'])){
        $title=$_POST['Title'];
        $stime=$_POST['stime'];
        $etime=$_POST['etime'];
        $d1 = new DateTime($etime);
        $d2 = new DateTime($stime);
        $meetid = uniqid();
        if(empty($title)||empty($etime)||empty($stime)){
            $failed="*All fields are required";
        }else if($d1<=$d2){
            $failed="*Enter Valid details";
        }else{
            $data=[
                'Title'         =>  $title,
                'Start Time'    =>  $d2->format('Y-m-d H:i'),
                'End Time'      =>  $d1->format('Y-m-d H:i'),
                'Creator'       =>  $_SESSION['Email'],
                'Presenter'     =>  $_SESSION['Username'],
                'Meeting ID'    =>  $meetid
            ];
            $data1=[
                'Name'          =>  $_SESSION['Username'],
                'Email'         =>  $_SESSION['Email'],
                'Meeting ID'    =>  $meetid
            ];
            $res=$col->insertOne($data);
            $res1=$col1->insertOne($data1);
            if($res->getInsertedCount()>0&&$res1->getInsertedCount()>0){
                $success="Meeting created successfully";
            }else{
                $failed="Failed to create meeting.";
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
    <title>Schedule Meeting</title>
    <link rel="stylesheet" href="Schedule_Meeting.css">
</head>
<body>
    <div id="container">
        <div id="box1">
            <?php
                include 'Header.php';
            ?>
        </div>
        <div id="box2">
            <span id="success"><?php echo $success;?></span>
            <span id="failed"><?php echo $failed;?></span>
            <fieldset id="a1">
                <legend>Schedule Meeting</legend>
                <form method="POST" action="">
                    <div class="tooltip">
                        <input class="inp" type="text" placeholder="Title" name="Title"><br>
                        <span class="tooltiptext"> *Title of Meeting </span>
                    </div>
                    <div class="tooltip">
                        <input class="inp" type="datetime-local" placeholder="Start Time" name="stime"><br>
                        <span class="tooltiptext"> *Start Time </span>
                    </div>
                    <div class="tooltip">
                        <input class="inp" type="datetime-local" placeholder="End Time" name="etime"><br>
                        <span class="tooltiptext"> *End Time </span>
                    </div>
                    <div id="inbox">
                        <input  type="submit" value="Create Meeting" name="cmeet">
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