<?php
    error_reporting(0);
    session_start();
    if(!isset($_SESSION['Username'])){
        header('location: Sign_In.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="Home.css">
    <script>
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","upcomingMeeting.php",true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("UpcomingMeetings").innerHTML = this.responseText;
            }
        };
        let xmlhttp1 = new XMLHttpRequest();
        xmlhttp1.open("GET","myMeeting.php",true);
        xmlhttp1.send();
        xmlhttp1.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("MyMeetings").innerHTML = this.responseText;
            }
        };
        let xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET","Requests.php",true);
        xmlhttp2.send();
        xmlhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Requests").innerHTML = this.responseText;
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
            <fieldset id="a1">
                <legend>Upcoming Meetings</legend>
                <div id="UpcomingMeetings">

                </div>
            </fieldset>
            <fieldset id="a1">
                <legend>My Meetings</legend>
                <div id="MyMeetings">

                </div>
            </fieldset>
            <fieldset id="a1">
                <legend>Requests</legend>
                <div id="Requests">

                </div>
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