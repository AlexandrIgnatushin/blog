<?php
include_once 'controllers/LoginController.php';
$login_controller = new LoginController($_REQUEST);

$login_controller->renderLoginForm();
