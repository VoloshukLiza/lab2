<?php
    require_once 'connect.php';
    session_start();

    function mysqli_fetch_all(mysqli_result $result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    if (isset($_POST['liked'])) {
        $post_id = $_POST['postid'];
        $result = mysqli_query($connect, "SELECT * FROM posts WHERE id = $post_id");
        $row = mysqli_fetch_array($result);
        $like = $row['likes'];
        if ($like < 0){
            $like = 0;
        }

        mysqli_query($connect, "UPDATE posts SET likes = $like + 1 WHERE id = $post_id");

        echo $like + 1;
        exit();
    }

    if (isset($_POST['unliked'])) {
        $post_id = $_POST['postid'];
        $result = mysqli_query($connect, "SELECT * FROM posts WHERE id = $post_id");
        $row = mysqli_fetch_array($result);
        $like = $row['likes'];
        if ($like < 0){
            $like = 0;
        }

        mysqli_query($connect, "UPDATE posts SET likes = $like - 1 WHERE id = $post_id");

        echo $like - 1;
        exit();
    }
//разделение на страницы
    $post = mysqli_query($connect, "SELECT * FROM `posts` ORDER BY `id` DESC");
    $posts = mysqli_fetch_all($post);
    $total = count($posts);
    $per_page = 5;
    $count_page = ceil( $total / $per_page );
    $page = $_GET['page']??1;
    $page = (int)$page;

    if(!$page || $page < 1){
        $page = 1;
    } else if ($page > $count_page) {
        $page = $count_page;
    }
    $start = ($page - 1) * $per_page;
    if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            echo $message;
            unset($_SESSION['message']);
    }
    

?>
<!DOCTYPE html>
<html>
    <head>
	   <title>Посты</title>
    <meta charset="utf-8">

</head>
<body>
    <h1>Лента новостей</h1>
    <div class ="gl">
        <div class="form">
            <form action="posts.php" method="POST" enctype="multipart/form-data">
                <label>Логин:</label><br>
                <input type="text" class="login" name ="login"><br>
                <label>Пост:</label><br>
                <textarea name="posts"></textarea>
                <br>
                <input type="submit" Value="Опубликовать" class="button1">
                <input type="reset" Value="Очистить" class="button2">
            </form>
        </div>
    <h2>Посты</h2>
        <?php
                $posts = array_slice($posts, $start, $per_page);
                foreach ($posts as $post) {
                    ?>
                    <div class="post">
                        <div style="margin-left: 0px; font-weight: bold;">
                            <?php echo $post['time']; ?>
                        </div>
                        <div class="user">
                            user: <?php echo $post['login']; ?>
                        </div>

                        <div class="text">
                            <textarea><?php echo $post['text']; ?></textarea><br>
                            
                            <div class="delete"
                            style="font-weight: bold; margin-top: 5px;">
                                <a href="delete.php?id=<?=$post['id']?>" style="text-decoration: none;  color:rgba(194, 0, 0, 0.74);">Удалить</a>
                            </div>
                        </div>
                        
                        <div style="font-size: 17px; margin: 10px 0px;">
                            
                            <span> Лайки: <?php echo $post['likes']; ?> <a href="likes.php?id=<?=$post['id']?>" style = "color: green;">+</a></span>
                            <br>
                            <span>Дизлайки: <?php echo $post['dislikes']; ?> <a href="dislikes.php?id=<?=$post['id']?>" style = "color: red;">-</a></span>
                        </div>
                        <p>________________________________________________</p>
                    </div>
                <?php
                }
                ?>
                <CENTER>
                    <?php
                    for ($i = 1; $i <= $count_page; $i++){
                        ?>
                        <a style="font-weight: bold"
                        href='?page=<?=$i?>'><?=$i?></a>
                        <?php
                    }
                    ?>
                </CENTER>
    </div>
</body>
</html>