<?php
include_once 'cores/Query.php';

class RegisterController {
    protected Query $conn;
    protected $request;

    function __construct($request) {
        $this->conn = new Query();
        $this->request = $request;
    }

    protected function isLoginExist($login): bool {
        $user_id = $this->conn->getOne("SELECT id FROM users WHERE login = ?", [$login]);

        return !empty($user_id);
    }

    protected function createUser($login, $password): void {
        $login = trim($login);
        $password = md5(md5(trim($password)));

        $this->conn->execute("INSERT INTO users (login, password)
                                  VALUES (?, ?)", [$login, $password]);

        header('Location: /login');
        exit;
    }

    protected function registerUser(): void {
        $errors = [];

        if (isset($this->request['submit'])) {
            if (strlen($this->request['login']) < 4 || strlen($this->request['login']) > 18) {
                $errors[] .= 'Введите логин больше 4 символов и меньше 18';
            }
            if ($this->isLoginExist($this->request['login'])) {
                $errors[] .= 'Такой логин уже существует';
            }
            if (strlen($this->request['password']) < 4) {
                $errors[] .= 'Слишком короткий пароль';
            }

            if (count($errors) === 0) {
                $this->createUser($this->request['login'], $this->request['password']);
            } else {
                echo "Ошибки" . "<br>";

                foreach ($errors as $error) {
                    echo "- " . $error . "<br>";
                }
            }
        }
    }

    public function renderUserRegisterForm(): void {
        $this->registerUser();

        echo "<h1>Register</h1>
              <form method='post'>
                Login <input type='text' name='login' required>
                Password <input type='text' name='password' required>
                <input type='submit' value='Register' name='submit'>
              </form>";
    }
}