<?php
    require 'vendor/autoload.php';
    //error_reporting(0);
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col=$db->Meetings;
    $col1=$db->Participants;
    session_name("PHPSESSID");
    session_start();
    $res=$col->find(['Creator'=>$_SESSION['Email'],'Meeting ID'=>$_GET['mid']])->toArray();
    echo '<table>';
    echo '<tr><th>Meeting ID</th><th>Title</th><th>Presenter</th><th>Start Time</th><th>End Time</th></tr>';
    echo '<tr><td>'.$res[0]['Meeting ID'].'</td><td>'.$res[0]['Title'].'</td><td>'.$res[0]['Presenter'].'</td><td>'.$res[0]['Start Time'].'</td><td>'.$res[0]['End Time'].'</td></tr>';
    echo '</table>';
    if(sizeof($res)>0){
        echo '<fieldset id="a1">';
        echo '<legend>Participants</legend>';
        echo '<table>';
        echo "<tr><th>Meeting ID</th><th>Name</th><th>Email-ID</th></tr>";
        $res=$col1->find(['Meeting ID'=>$_GET['mid']]);
        foreach($res as $data1){
            echo "<tr><td>".$data1['Meeting ID']."</td><td>".$data1['Name']."</td><td>".$data1['Email']."</td></tr>";
        }
        echo '</table>';
        echo '</fieldset>';
    }else{
        echo "No Participants";
    }
?>