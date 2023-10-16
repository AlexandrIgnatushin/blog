<?php
include_once 'cores/Query.php';

class Rights {
    protected Query $conn;

    function __construct() {
        $this->conn = new Query();
    }

    public function checkAccess(): bool {
        if (isset($_COOKIE['hash']) && isset($_COOKIE['id'])) {
            $user_data = $this->conn->getOne("SELECT id, hash, login, INET_NTOA(ip) AS ip
                                                  FROM users
                                                  WHERE id = ?", [intval($_COOKIE['id'])]);

            if ($user_data) {
                if ($user_data['hash'] !== $_COOKIE['hash']) {
                    $this->clearCookie();
                    return false;
                }
                if ($user_data['ip'] !== $_SERVER['REMOTE_ADDR']) {
                    $this->clearCookie();
                    return false;
                }

                return true;
            } else {
                return false;
            }
        } else {
            $this->clearCookie();
            return false;
        }
    }

    public function getRole() {
        if (isset($_COOKIE['id'])) {
            return $this->conn->getItem("SELECT role FROM users WHERE id = ?",
                                             [intval($_COOKIE['id'])]);
        }

        return false;
    }

    protected function clearCookie(): void {
        setcookie('id', '');
        setcookie('hash', '');
        unset($_GET['login']);
    }
}