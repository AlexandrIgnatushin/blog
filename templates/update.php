<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<?php
if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $descr_min = $_POST['descr_min'];
    $description = $_POST['descr'];
    $cid = (int) $_POST['cid'];
    $published = isset($_POST['published']) ? 1 : 0;
    $post_id = (int) $route[2];
    $dir = $_SERVER['DOCUMENT_ROOT']."/static/images/";

    if ($_FILES['image']['error'] !== 0) {
        $image = $conn->getItem("SELECT image FROM posts WHERE id = ?", [$post_id]);
    } else {
        move_uploaded_file($_FILES['image']['tmp_name'], $dir.$_FILES['image']['name']);

        $image = $_FILES['image']['name'];
    }

    $update_post = $conn->execute("UPDATE posts
                                       SET cid = ?, title = ?, descr_min = ?,
                                           description = ?, image = ?, published = ?
                                       WHERE id = ?",
        [$cid, $title, $descr_min, $description, $image, $published, $post_id]);

    if ($update_post) {
        header('Location: /admin');
        exit;
    } else {
        echo 'Что-то пошло не так';
    }
}
?>

<?php
$action = 'update';
$post_id = $route[2];

$categories = $conn->getAll("SELECT id, title FROM categories");
$data_for_update = $conn->getOne("SELECT * FROM posts WHERE id = ?", [$post_id]);

$cid = $data_for_update['cid'];
$title = $data_for_update['title'];
$descr_min = $data_for_update['descr_min'];
$descr = $data_for_update['description'];
$image = $data_for_update['image'];
$published = (int) $data_for_update['published'];

include_once "templates/form.php";
?>
</body>
</html>
