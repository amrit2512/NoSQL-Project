<?php
    require 'vendor/autoload.php';
    //error_reporting(0);
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col1=$db->Meetings;
    $col=$db->Participants;
    session_name("PHPSESSID");
    session_start();
    $c=$col->count(['Email'=>$_SESSION['Email']]);
    $res=$col->find(['Email'=>$_SESSION['Email']]);
    if($c>0){
        $i=0;
        echo '<table>';
        echo "<tr><th>Meeting ID</th><th>Title</th><th>Presenter</th><th>Start Time</th><th>End Time</th></tr>";
        foreach($res as $data){
            $res1=$col1->find(['Meeting ID'=>$data['Meeting ID']]);
            foreach($res1 as $data1){
                $e="Edit Satus";
                $f="edit.php?mid=";
                if($data1['Creator']==$_SESSION['Email']){
                    $e="Delete Meeting";
                    $f="delete.php?mid=";
                }
                echo "<tr><td>".$data1['Meeting ID']."</td><td>".$data1['Title']."</td><td>".$data1['Presenter']."</td><td>".$data1['Start Time']."</td><td>".$data1['End Time'].'</td><td><button><a href="'.$f.$data1['Meeting ID'].'">'.$e.'</a></button></td></tr>';
                $i++;
                if($i==5){
                    break;
                }
            }
        }
        echo '</table>';
    }else{
        echo "No upcoming meetings";
    }
?>