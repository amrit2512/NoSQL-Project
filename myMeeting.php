<?php
    require 'vendor/autoload.php';
    //error_reporting(0);
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col=$db->Meetings;
    session_name("PHPSESSID");
    session_start();
    $c=$col->count(['Creator'=>$_SESSION['Email']]);
    $res=$col->find(['Creator'=>$_SESSION['Email']]);
    if($c>0){
        $i=0;
        echo '<table>';
        echo "<tr><th>Meeting ID</th><th>Title</th><th>Start Time</th><th>End Time</th></tr>";
        foreach($res as $data1){
            echo "<tr><td>".$data1['Meeting ID']."</td><td>".$data1['Title']."</td><td>".$data1['Start Time']."</td><td>".$data1['End Time']."</td>".'<td><button><a href="delete.php?mid='.$data1['Meeting ID'].'">Delete meeting</a></button></td>'.'</td><td><button><a href="add.php?mid='.$data1['Meeting ID'].'">Add Participants</a></button></td>'.'</td><td><button><a href="show.php?mid='.$data1['Meeting ID'].'">Show Participants<a></button></td>'."</tr>";
            $i++;
            if($i==5){
                break;
            }
        }
        echo '</table>';
    }else{
        echo "No meetings";
    }
?>