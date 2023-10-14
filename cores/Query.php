<?php

use Couchbase\BaseException;

class Query {
    public $db = null;
    function __construct() {
        $this->db();
    }
    public function db() {
        try {
            $this->db = new PDO('mysql:host=localhost;
                                     port=3306;dbname=test;',
                            'debian-sys-maint',
                            '5TVmlQIRRP4GlgRT');

            return $this->db;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

            die();
        }
    }
    public function getAll(string $sql, array $arguments = []): array {
        $result = [];
        $query = $this->db->prepare($sql);

        if (!$query->execute($arguments)) {
            error_log(json_encode([
                'error' => $query->errorInfo(),
                'sql' => $sql
            ]));

            throw new BaseException(json_encode($query->errorInfo()), 500, $query->errorInfo()[2]);
        }

        while ($row = $query->fetch()) {
            $result[] = $row;
        }

       return $result;
    }
    public function execute(string $sql, array $arguments = []) {
        $query = $this->db->prepare($sql);

        if (!$query->execute($arguments)) {
            $error = $query->errorInfo();
            $error['sql'] = $sql;
            $error['args'] = $arguments;

            throw new BaseException(json_encode([
                'sql' => $sql,
                'error' => $query->errorInfo(),
                'args' => $arguments
            ]), 500, $query->errorInfo()[2]);
        }

        return $query;
    }
}
