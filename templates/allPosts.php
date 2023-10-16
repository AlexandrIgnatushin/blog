<?php
include_once 'controllers/AllPostsController.php';
$posts_controller = new AllPostsController($_REQUEST);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Posts</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <header class="all-posts-header">
        <div class="all-posts-header__nav">
            <?php $posts_controller->renderCategories();?>
            <?php $posts_controller->renderAuthItems();?>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="all-posts-container">
                <?php $posts_controller->renderPostsItems();?>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <?php $posts_controller->renderPagging();?>
        </div>
    </footer>
</body>
</html>





