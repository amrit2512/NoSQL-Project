<?php
    error_reporting(0);
    session_name("PHPSESSID");
    session_start();
    session_destroy();
    header('location: Index.php');
    die();
?>