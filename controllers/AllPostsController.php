<?php
include_once 'traits/LibRenderElements.php';
include_once 'cores/Rights.php';
include_once 'cores/Query.php';

class AllPostsController {
    use \traits\LibRenderElements;

    protected Query $conn;
    protected Rights $rights;
    protected int $posts_per_page = 2;
    protected $current_page;

    function __construct($request) {
        $this->conn = new Query();
        $this->rights = new Rights();
        $this->current_page = $request['page'] ?? 1;
    }

    public function renderPostsItems(): void {
        $current_page = (int) $this->current_page;
        $offset = ($current_page - 1) * $this->posts_per_page;

        $posts = $this->conn->getAll("SELECT * FROM posts WHERE published = 1
                                          LIMIT $offset, $this->posts_per_page");

        $inner_html = "";

        foreach ($posts as $item) {

            $inner_html .= "<div class='post'>
                                <h2 class='post-title'>{$item["title"]}</h2>
                                <div class='post-content-wrap'>
                                    <img class='img-post-title' src='/static/images/{$item["image"]}'>
                                    <p class='descr-min'>{$item["descr_min"]}</p>
                                </div>
                                <a class='details' href='/post/{$item["id"]}'>Подробнее</a>
                            </div>";
        }

        echo $inner_html;
    }

    public function renderPagging(): void {
        $count_all_posts = $this->conn->getCount("SELECT * FROM posts WHERE published = 1");
        $total_pages = ceil($count_all_posts / $this->posts_per_page);

        echo "<div class='pagging'>";

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }

        echo "</div>";
    }
}