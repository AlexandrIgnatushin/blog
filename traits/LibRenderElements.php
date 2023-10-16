<?php

namespace traits;

trait LibRenderElements {
    public function renderCategories(): void {
        $categories = $this->conn->getAll("SELECT * FROM categories");

        echo "<nav class='nav-elems'>";
        echo "<a href='/'>Всё</a> ";
        foreach ($categories as $category) {
            echo "<a href='/category/{$category['id']}'>{$category['title']}</a> ";
        }
        echo "</nav>";
    }

    public function renderAuthItems(): void {
        if (!$this->rights->checkAccess()) {
            echo "<nav class='nav-elems'>";
            echo "<a href='/register'>Регистрация</a> ";
            echo "<a href='/login'>Авторизация</a> ";
            echo "</nav>";
        } else {
            echo "<nav class='nav-elems'>";
            echo "<a href='/'>На главную</a> ";
            echo "<a href='/admin'>Админ панель</a> ";
            echo "</nav>";
        }
    }
}