<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<?php
if (isset($_POST['submit'])) {
    $cid = (int) $_POST['cid'];
    $title = trim($_POST['title']);
    $descr_min = $_POST['descr_min'];
    $description = $_POST['descr'];
    $published = isset($_POST['published']) ? 1 : 0;

    $dir = $_SERVER['DOCUMENT_ROOT']."/static/images/";
    move_uploaded_file($_FILES['image']['tmp_name'], $dir.$_FILES['image']['name']);
    $image = $_FILES['image']['name'];

    $create_data = $conn->execute("INSERT INTO posts (cid, title, descr_min,
                                                          description, image, published)
                                       VALUES (?, ?, ?, ?, ?, ?)",
        [$cid, $title, $descr_min, $description, $image, $published]);

    if ($create_data) {
        header('Location: /admin');
        exit;
    } else {
        echo 'Что-то пошло не так';
    }
}
?>

<?php
$action = 'create';
$categories = $conn->getAll("SELECT id,title FROM categories");

include_once 'templates/form.php';
?>
</body>
</html>
