<?php

    session_start();
    require_once 'connect.php';

    $id = $_GET['id'];

    mysqli_query($connect, "DELETE FROM `posts` WHERE `posts`.`id` = '$id'");
    header('Location: idex.php');
 ?>