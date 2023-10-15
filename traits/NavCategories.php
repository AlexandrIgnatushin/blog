<?php

namespace traits;

trait NavCategories {
    public function renderCategories(): void {
        $categories = $this->conn->getAll("SELECT * FROM categories");

        echo "<nav>";
        echo "<a href='/'>Всё</a> ";
        foreach ($categories as $category) {
            echo "<a href='/category/{$category['id']}'>{$category['title']}</a> ";
        }
        echo "</nav>";
    }
}