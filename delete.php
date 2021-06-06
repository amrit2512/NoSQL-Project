<?php
    require 'vendor/autoload.php';
    //error_reporting(0);
    $client = new MongoDB\Client('mongodb+srv://User:25121999@test1.7e49r.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
    $db=$client->MeetingAPI;
    $col1=$db->Meetings;
    $col2=$db->Participants;
    $col3=$db->Requests;
    session_name("PHPSESSID");
    session_start();
    $res1=$col1->deleteMany(["Meeting ID"=>$_GET['mid']]);
    $res2=$col2->deleteMany(["Meeting ID"=>$_GET['mid']]);
    $res3=$col3->deleteMany(["Meeting ID"=>$_GET['mid']]);
    header("location: Home.php");
    die();
?>