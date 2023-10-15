<?php
include_once 'traits/NavCategories.php';
include_once 'cores/Query.php';

class CategoryController {
    use \traits\NavCategories;
    protected Query $conn;
    protected int $posts_per_page = 2;
    protected $category_id;
    protected $num_page;

    function __construct($route) {
        $this->conn = new Query();
        $this->category_id = $route[1];
        $this->num_page = $route[2] ?? 1;
    }

    protected function getCategory(): array {
        return $this->conn->getOne("SELECT * FROM categories WHERE id = ?", [$this->category_id]);
    }

    public function renderPostsForCategory(): void {
        $current_page = (int) $this->num_page;
        $offset = ($current_page - 1) * $this->posts_per_page;
        $category = $this->getCategory();

        if (empty($category)) {
            header('Location: /templates/404.php');

            exit;
        }

        $posts_for_category = $this->conn->getAll("SELECT * FROM posts
                                                       WHERE cid = ? AND published = 1
                                                       LIMIT $offset, $this->posts_per_page",
                                                       [$this->category_id]);

        $category_info = "<h1>Категория: {$category['title']}</h1>
                          <p>{$category['description']}</p> ";

        $posts = "";

        foreach ($posts_for_category as $post) {
            $posts .= "<div>
                            <h2>{$post["title"]}</h2>
                            <img src='/static/images/{$post["image"]}' width=200>
                            <p>{$post["descr_min"]}</p>
                            <a href='/post/{$post["id"]}'>Подробнее</a>
                        </div>";
        }

        echo $category_info;
        echo $posts;
    }

    public function renderPagging(): void {
        $count_posts = $this->conn->getCount("SELECT * FROM posts
                                                  WHERE cid = ?
                                                  AND published = 1", [$this->category_id]);

        $total_pages = ceil($count_posts / $this->posts_per_page);

        echo "<div>";

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='/category/{$this->category_id}/$i'>$i</a> ";
        }

        echo "</div>";
    }
}