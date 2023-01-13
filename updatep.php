<?php

    session_start();
    require_once 'connect.php';
    $id = htmlspecialchars($_POSTS['id'] ?? '');
    $posts = htmlspecialchars($_POSTS['posts'] ?? '');
    $login = htmlspecialchars($_POSTS['login'] ?? '');
    $date = date("Y-m-d H:i:s");
    if($posts ==''){
        $_SESSION['message'] = "Поле поста не может быть пустым";
        header('Location: update.php'.'?id='.$id);
    }
    elseif($login ==''){
        $_SESSION['message'] = "Введите логин";
        header('Location: idex.php'.'?id='.$id);
    }
    else{
    if(isset($_FILES['img']) && $_FILES['img']['name'] != ''){
    $path = 'uploads/'. time(). $_FILES['img']['name'];
        }
    else{
    $path = '';
    }
    $q = "UPDATE `posts` SET `login`='$login',`text`='$posts',`time`='$date',`image`='$path' WHERE `id` = '$id'";
    mysqli_query($connect,$q);
    header('Location: idex.php');
}
 ?>