<?php
include_once 'controllers/RegisterController.php';
$register_controller = new RegisterController($_REQUEST);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <main class="auth-main">
        <?php $register_controller->renderUserRegisterForm();?>
    </main>
</body>
</html>
