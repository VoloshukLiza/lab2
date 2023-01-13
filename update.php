<?php

    session_start();
    require_once 'connect.php';

    $posts_id = $_GET['id'];
    $posts = mysqli_query($connect, "SELECT * FROM posts WHERE id = $posts_id ");
    $posts = mysqli_fetch_assoc($posts);
    if (isset($_SESSION['message']))
            {
            $message = $_SESSION['message'];
            echo $message;
            unset($_SESSION['message']);
            }
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Forum</title>
    <meta charset="utf-8">
    <link rel = "stylesheet" href="css/main.css">
</head>
<body>
    <h1>Обновление поста</h1>
    <div class ="gl">
        <div class="form">
            <form action="updatep.php" method="POSTS" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$posts['id']?>">
                <label>Логин:</label><br>
                <input type="text" class="login" name ="login" value="<?=$posts['login']?>"><br>
                <textarea name="posts"><?=$post['text']?></textarea>
                <input type="file" Value="Изображение" name="img" style="margin: 10px;">
                <br>
                <input type="submit" Value="Изменить" class="button">
                <input type="reset" Value="Очистить" class="button">
            </form>
        </div>

    </div>
</body>
</html>