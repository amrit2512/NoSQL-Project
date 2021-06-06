<?php
    require 'vendor/autoload.php';
    //error_reporting(0);
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col=$db->Requests;
    session_name("PHPSESSID");
    session_start();
    $c=$col->count(['Email'=>$_SESSION['Email']]);
    $res=$col->find(['Email'=>$_SESSION['Email']]);
    if($c>0){
        $i=0;
        echo '<table>';
        echo "<tr><th>Meeting ID</th><th>Title</th><th>Presenter</th><th>Start Time</th><th>End Time</th></tr>";
        foreach($res as $data1){
            echo "<tr><td>".$data1['Meeting ID']."</td><td>".$data1['Title']."</td><td>".$data1['Name']."</td><td>".$data1['Start Time']."</td><td>".$data1['End Time']."</td>".'<td><button><a href="accept.php?mid='.$data1['Meeting ID'].'">Accept</a></button></td>'.'</td><td><button><a href="reject.php?mid='.$data1['Meeting ID'].'">Reject<a></button></td>'."</tr>";
            $i++;
            if($i==5){
                break;
            }
        }
        echo '</table>';
    }else{
        echo "No Pending Requests";
    }
?>