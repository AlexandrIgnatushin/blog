<?php
$result = $conn->getAll("SELECT * FROM posts");

$inner_html = "";

foreach ($result as $item) {
    $inner_html .= "<div>
                        <h2>{$item["title"]}</h2>
                        <img src='static/images/{$item["image"]}' width=200>
                        <p>{$item["descr_min"]}</p>
                        <a href='/post/{$item["url"]}'>Подробнее</a>
                    </div>";
}

echo $inner_html;
