<?php
include_once 'cores/Query.php';

$conn = new Query();

$route = explode('/', $_GET['route']);

switch ($route) {
    case ($route[0] === ''):
        include_once 'templates/allPosts.php';
        break;
    default:
        include_once 'templates/404.php';
}
