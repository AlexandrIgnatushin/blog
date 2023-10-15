<?php
include_once 'controllers/PostController.php';
$post_controller = new PostController($route);

$post_controller->renderPost();

