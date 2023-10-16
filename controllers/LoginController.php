<?php
include_once 'cores/Query.php';

class LoginController {
    protected Query $conn;
    protected $request;

    function __construct($request) {
        $this->conn = new Query();
        $this->request = $request;
    }

    protected function checkUser($login, $password): array|bool {
        $login = trim($login);
        $password = md5(md5(trim($password)));

        return $this->conn->getOne("SELECT * FROM users WHERE login = ? AND password = ?",
            [$login, $password]);
    }

    protected function generateHash($count): string {
        $string = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789";
        $hash = '';

        for ($i = 0; $i < $count; $i++) {
            $hash .= $string[rand(0, 60)];
        }

        return $hash;
    }

    protected function updateUserAuthData($user_id, $hash, $ip): bool {
        return $this->conn->execute("UPDATE users
                                         SET hash = ?, ip = INET_ATON(?)
                                         WHERE id = ?", [$hash, $ip, $user_id]);
    }

    protected function loginUser(): void {
        if (isset($this->request['submit'])) {
            $user = $this->checkUser($this->request['login'], $this->request['password']);

            if ($user) {
                $hash = md5($this->generateHash(30));
                $ip = $_SERVER['REMOTE_ADDR'];

                $is_update = $this->updateUserAuthData($user['id'], $hash, $ip);

                if ($is_update) {
                    setcookie('id', $user['id'], time() + 60 * 60 * 24 * 30, '/');
                    setcookie('hash', $hash, time() + 60 * 60 * 24 * 30, '/');

                    header('Location: /admin');
                    exit;
                } else {
                    echo 'Что то пошло не так';
                }
            } else {
                echo 'Пожалуйста, зарегестрируйтесь или введите верно данные авторизации';
            }
        }
    }

    public function renderLoginForm(): void {
        $this->loginUser();

        echo "<h1>Страница авторизации</h1>
              <form class='auth-form' method='post'>
                Логин <input type='text' name='login' required>
                Пароль <input type='text' name='password' required>
                <input class='details' type='submit' value='Login' name='submit'>
              </form>";
    }
}