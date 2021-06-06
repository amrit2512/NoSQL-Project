<?php
    require 'vendor/autoload.php';
    //error_reporting(0);
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col=$db->Meetings;
    session_name("PHPSESSID");
    session_start();
    $res=$col->find(['Meeting ID'=>$_GET['mid']])->toArray();
    echo '<table>';
    echo '<tr><th>Meeting ID</th><th>Title</th><th>Presenter</th><th>Start Time</th><th>End Time</th></tr>';
    echo '<tr><td>'.$res[0]['Meeting ID'].'</td><td>'.$res[0]['Title'].'</td><td>'.$res[0]['Presenter'].'</td><td>'.$res[0]['Start Time'].'</td><td>'.$res[0]['End Time'].'</td></tr>';
    echo '</table>';
?>