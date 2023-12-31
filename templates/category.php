<?php
include_once 'controllers/CategoryController.php';
$category_controller = new CategoryController($route);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All posts</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <header class="all-posts-header">
        <div class="all-posts-header__nav">
            <?php $category_controller->renderCategories(); ?>
            <?php $category_controller->renderAuthItems(); ?>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="all-posts-container">
                <?php $category_controller->renderPostsForCategory(); ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <?php $category_controller->renderPagging(); ?>
        </div>
    </footer>
</body>
</html>


