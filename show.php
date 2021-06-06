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
    <title>Show Participants</title>
    <link rel="stylesheet" href="show.css">
    <script>
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","showParticipants.php?mid=<?php echo $_GET['mid'];?>",true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("box2").innerHTML = this.responseText;
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
            
        </div>
        <div id="box3">
            <?php
                include 'Footer.html';     
            ?>
        </div>
    </div>
</body>
</html>