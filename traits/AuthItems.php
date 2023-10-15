<?php

namespace traits;

trait AuthItems {
    public function renderAuthItems(): void {
        echo "<nav>";
        echo "<a href='/register'>Регистрация</a> ";
        echo "<a href='/login'>Авторизация</a> ";
        echo "</nav>";
    }
}