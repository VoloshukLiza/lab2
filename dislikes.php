<?php
	require_once 'connect.php';

	$id = $_GET['id'];

	$q = "SELECT * FROM `posts` WHERE `id` = '$id'";
	$result = mysqli_query($connect, $q);
	$posts = $result->fetch_assoc();
	$dislikes = (int)$posts['dislikes'] + 1;

	$q = "UPDATE `posts` SET `dislikes` = '$dislikes' WHERE `id` = '$id'";

	mysqli_query($connect, $q);

	header('Location: idex.php');
?>