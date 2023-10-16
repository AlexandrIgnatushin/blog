<?php
include_once 'controllers/PostController.php';
$post_controller = new PostController($route);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div class="container">
        <?php $post_controller->renderPost();?>
    </div>
</body>
</html>




