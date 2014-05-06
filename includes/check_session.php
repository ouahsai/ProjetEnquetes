<?php

session_start();

//verification existence de var de session
if(!isset($_SESSION["user_id"]) || !$_SESSION['user_id']){
    header('Location: index.php');
    exit();
}

