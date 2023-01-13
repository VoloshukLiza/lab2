<?php

    session_start();
    require_once 'connect.php';

    #$posts = htmlspecialchars($_POSTS['posts'] ?? '');
    $posts = filter_var(trim($_POST['posts']), FILTER_SANITIZE_STRING);
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    if(empty($posts)){
        $_SESSION['message'] = "Поле поста не может быть пустым";
        header('Location: idex.php');
    }
    else if(empty($login)){
        $_SESSION['message'] = "Введите логин";
        header('Location: idex.php');
    }
    else{
    $date = date("Y-m-d H:i:s");
    if(isset($_FILES['img']) && $_FILES['img']['name'] != ''){
    $path = 'uploads/'. time(). $_FILES['img']['name'];
        }
    else{
    $path = '';
    }
    if(!move_uploaded_file($_FILES['img']['tmp_name'], $path)){
        echo "Ошибка загрузки файла";
    }
    else { move_uploaded_file($_FILES['img']['tmp_name'], $path);}
    $q = "INSERT INTO `posts` (`id`, `login`, `text`, `time`, `image`) VALUES (NULL, '$login', '$posts', '$date', '$path');";
    mysqli_query($connect, $q);
    header('Location: idex.php');
}
 ?>