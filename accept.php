<?php    
    require 'vendor/autoload.php';
    //error_reporting(0);
    session_name("PHPSESSID");
    session_start();
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col2=$db->Participants;
    $col3=$db->Requests;
    $res2=$col3->deleteMany(["Meeting ID"=>$_GET['mid'],'Email'=>$_SESSION['Email']]);
    $data=[
        'Meeting ID'=>$_GET['mid'],
        'Name'      =>$_SESSION['Username'],
        'Email'     =>$_SESSION['Email']
    ];
    $res3=$col2->insertOne($data);
    header("location: Home.php");
    die();
?>