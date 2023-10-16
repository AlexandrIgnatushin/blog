<?php
include_once 'controllers/AdminController.php';
$admin_controller = new AdminController($route);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <header class="all-posts-header">
        <div class="all-posts-header__nav">
            <?php $admin_controller->renderAuthItems(); ?>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>Админ панель</h1>
            <div class="all-posts-container">
                <?php $admin_controller->renderPage(); ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <?php $admin_controller->renderPagging(); ?>
        </div>
    </footer>
</body>
</html>