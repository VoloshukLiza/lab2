<?php
	require_once 'connect.php';

	$id = $_GET['id'];

	$q = "SELECT * FROM `posts` WHERE `id` = '$id'";
	$result = mysqli_query($connect, $q);
	$posts = $result->fetch_assoc();
	$likes = (int) $posts['likes'] + 1;

	$q = "UPDATE `posts` SET `likes` = '$likes' WHERE `id` = '$id'";

 mysqli_query($connect, $q);

 header('Location: idex.php');
?>
