<?php
include_once 'controllers/CategoryController.php';
$category_controller = new CategoryController($route);

$category_controller->renderCategories();
$category_controller->renderAuthItems();
$category_controller->renderPostsForCategory();
$category_controller->renderPagging();