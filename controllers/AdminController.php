<?php
include_once 'traits/LibRenderElements.php';
include_once 'cores/Rights.php';
include_once 'cores/Query.php';

class AdminController {
    use \traits\LibRenderElements;

    protected Query $conn;
    protected Rights $rights;
    protected int $posts_per_page = 2;
    protected $current_page;

    function __construct($route) {
        $this->conn = new Query();
        $this->rights = new Rights();
        $this->current_page = empty($route[1]) ? 1 : $route[1];
    }

    protected function getAllPosts() {
        $current_page = (int) $this->current_page;
        $offset = ($current_page - 1) * $this->posts_per_page;

        return $this->conn->getAll("SELECT * FROM posts LIMIT $offset, $this->posts_per_page");
    }

    public function getHtmlPosts($posts, $role) {
        $view_posts = "";

        foreach ($posts as $post) {
            if ($role == 'admin') {
                $view_posts .= "<div class='post'>
                                    <h2 class='post-title'>{$post["title"]}</h2>
                                    <div class='post-content-wrap'>
                                        <img class='img-post-title' src='/static/images/{$post["image"]}'>
                                        <p class='descr-min'>{$post["descr_min"]}</p>
                                    </div>
                                    <div class='detail-wrap'>
                                        <a class='details' href='/admin/delete/{$post["id"]}'>Удалить</a>
                                        <a class='details' href='/admin/update/{$post["id"]}'>Обновить</a>
                                    </div>
                                </div>";
            } else {
                $view_posts .= "<div class='post'>
                                    <h2 class='post-title'>{$post["title"]}</h2>
                                    <div class='post-content-wrap'>
                                        <img class='img-post-title' src='/static/images/{$post["image"]}'>
                                        <p class='descr-min'>{$post["descr_min"]}</p>
                                    </div>
                                    <a class='details' href='/admin/update/{$post["id"]}'>Обновить</a>
                                </div>";
            }
        }

        return $view_posts;
    }

    public function renderPagging(): void {
        $count_all_posts = $this->conn->getCount("SELECT * FROM posts");
        $total_pages = ceil($count_all_posts / $this->posts_per_page);

        echo "<div class='pagging'>";

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='/admin/$i'>$i</a> ";
        }

        echo "</div>";
    }

    public function renderPage(): void {
        $all_posts = $this->getAllPosts();
        $role = $this->rights->getRole();

        echo $role == "admin" ? "<a class='details' href='/admin/create/'>Создать новый пост</a>" : "";

        echo $this->getHtmlPosts($all_posts, $role);
    }
}