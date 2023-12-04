<?php
    session_start();
    $userID = $_SESSION['user_id'];
    echo 'UserID: ';
    echo $userID;
    if (isset($_SESSION['user_id'])) {
        echo $_SESSION['user_id'];
    } 
    else {
        echo 'user_id not set';
    }
?>
