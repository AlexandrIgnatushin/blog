<?php
include_once 'cores/Query.php';
include_once 'cores/Rights.php';

$conn = new Query();
$rights = new Rights();

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
    case ($route[0] === 'register'):
        include_once 'templates/register.php';
        break;
    case ($route[0] === 'login'):
        include_once 'templates/login.php';
        break;
    case ($route[0] === 'admin' && $route[1] === 'delete' && isset($route[2])):
        if ($rights->checkAccess() && $rights->getRole() == 'admin') {
            $post_id = (int) $route[2];
            $conn->execute("DELETE FROM posts WHERE id = ?", [$post_id]);


            header('Location: /admin');
            exit();
        }

        header('Location: /login');
        break;
    case ($route[0] === 'admin' && $route[1] === 'update' && isset($route[2])):
        if ($rights->checkAccess()) {
            include_once 'templates/update.php';
            break;
        }

        header('Location: /login');
        break;
    case ($route[0] === 'admin' && $route[1] === 'create'):
        if ($rights->checkAccess() && $rights->getRole() == 'admin') {
            include_once 'templates/create.php';
            break;
        }

        header('Location: /login');
        break;
    case ($route[0] === 'admin'):
        if ($rights->checkAccess()) {
            include_once 'templates/admin.php';
            break;
        }

        header('Location: /login');
        break;
    default:
        include_once 'templates/404.php';
}
