<?php
include_once 'cores/Query.php';

$conn = new Query();

$route = explode('/', $_GET['route']);

switch ($route) {
    case ($route[0] === ''):
        include_once 'templates/allPosts.php';
        break;
    case ($route[0] === 'post' && isset($route[1])):
        include_once 'templates/post.php';
        break;
    case ($route[0] === 'category' && isset($route[1])):
        include_once 'templates/category.php';
        break;
    default:
        include_once 'templates/404.php';
}
