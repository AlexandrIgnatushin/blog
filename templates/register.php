<?php
include_once 'controllers/RegisterController.php';
$register_controller = new RegisterController($_REQUEST);

$register_controller->renderUserRegisterForm();