<?php
include_once 'cores/Query.php';

class PostController {
    protected Query $conn;
    protected $post_id;

    function __construct($route) {
        $this->conn = new Query();
        $this->post_id = $route[1];
    }

    protected function getPost(): array {
        return $this->conn->getOne("SELECT title, image,
                                               descr_min, description
                                         FROM posts WHERE id = ?", [$this->post_id]);

    }

    public function renderPost(): void {
        $post = $this->getPost();

        if (empty($post)) {
            header('Location: /templates/404.php');

            exit;
        }

        echo  "<div class='big-post'>
                     <h2 class='big-post-title'>{$post["title"]}</h2>
                     <img class='big-post-img' src='/static/images/{$post["image"]}'>
                     <p class='big-post-descr-min'>{$post["descr_min"]}</p>
                     <p class='big-post-descr'>{$post['description']}</p>
               </div>";
    }
}