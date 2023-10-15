<?php
include_once 'controllers/AllPostsController.php';
$posts_controller = new AllPostsController($_REQUEST);

$posts_controller->renderCategories();
$posts_controller->renderPostsItems();
$posts_controller->renderPagging();