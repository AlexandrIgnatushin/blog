<form class="head-form" method="post" enctype="multipart/form-data">
    <p>Заголовок: </p>
    <input type="text" name="title" value="<?php echo $title?>">
    <p>Короткое описание: </p>
    <textarea name="descr_min"><?php echo $descr_min?></textarea>
    <p>Полное описание: </p>
    <textarea name="descr"><?php echo $descr?></textarea>

    <p>Категория:
        <select name="cid">
            <?php
            $out = '';

            foreach ($categories as $category) {
                if ($category['id'] === $cid) {
                    $out .= "<option value='{$category['id']}' selected>{$category['title']}</option>";
                } else {
                    $out .= "<option value='{$category['id']}'>{$category['title']}</option>";
                }
            }

            echo $out;
            ?>
        </select>
    </p>

    <img src="/static/images/<?php echo $image?>" width="200"/>
    <p>Выбрать новое изображение <input type="file" name="image"></p>

    <p>Опубликовать:
        <?php
        if ($published === 1) {
            echo "<input id='published' type='checkbox' name='published' checked/>";
        } else {
            echo "<input id='published' type='checkbox' name='published'/>";
        }
        ?>
    </p>

    <input class="details" type="submit" value="<?php echo $action?>" name="submit">
</form>

