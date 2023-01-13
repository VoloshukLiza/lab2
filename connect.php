<?php

    $connect = mysqli_connect('localhost', 'root', 'root', 'tape');

	#echo $connect;
    if (!$connect) {
        die('Error connect to DataBase');
    }
 ?>