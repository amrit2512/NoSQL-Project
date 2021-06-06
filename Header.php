<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Header.css">
</head>
<body>
    <div id="header">
        <div id="sub1">
            Meeting Scheduler
        </div>
        <div id="sub2">
            <div>
                <a id="ssub2" href="Home.php">Home</a><a id="ssub2" href="Schedule_Meeting.php">Schedule Meeting</a>
            </div>
            <div>
                <span id="subh2">Hi,<?php echo " ".$_SESSION['Username'];?></span><a id="ssub2" href="LogOut.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>