<?php
    require 'vendor/autoload.php';
    error_reporting(0);
    session_start();
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col=$db->Participants;
    $col2=$db->Requests;
    $col3=$db->Meetings;
    if(!isset($_SESSION['Username'])){
        header('location: Sign_In.php');
        die();
    }
    if(isset($_POST['att'])){
        header('location: Home.php');
        die();
    }
    if(isset($_POST['nat'])){
        $res=$col->deleteMany(['Meeting ID'=>$_GET['mid'],'Email'=>$_SESSION['Email']]);
        header('location: Home.php');
        die();
    }
    if(isset($_POST['nde'])){
        $res1=$col3->find(['Meeting ID'=>$_GET['mid']])->toArray();
        $res=$col->deleteMany(['Meeting ID'=>$_GET['mid'],'Email'=>$_SESSION['Email']]);
        $data=[
            'Meeting ID'=>$_GET['mid'],
            'Title'     =>$res1[0]['Title'],
            'Start Time'=>$res1[0]['Start Time'],
            'End Time'  =>$res1[0]['End Time'],
            'Email'     =>$_SESSION['Email'],
            'Name'      =>$_SESSION['Username']
        ];
        $res2=$col2->insertOne($data);
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
    <title>Show Participants</title>
    <link rel="stylesheet" href="edit.css">
    <script>
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","meeting_detail.php?mid=<?php echo $_GET['mid'];?>",true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("details").innerHTML = this.responseText;
            }
        };
    </script>
</head>
<body>
    <div id="container">
        <div id="box1">
            <?php
                include 'Header.php';
            ?>
        </div>
        <div id="box2">
            <div id="details">
            
            </div>
            <fieldset id="a1">
                <legend>Edit Status</legend>
                <form method="POST" action="">
                    <div id="inbox">
                        <input  type="submit" value="Attending" name="att">
                        <input  type="submit" value="Not Attending" name="nat">
                        <input  type="submit" value="Not Decided" name="nde">
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