<?php

class DBConnect
{
    private static $instance = null;
    private PDO $pdo;

    public function __construct(
        string $dsn,
        string $username,
        string $password
    ) {
        try {
            $this->pdo = new PDO(
                dsn: $dsn,
                username: $username,
                password: $password
            );
            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public static function getInstance(
        string $dsn,
        string $username,
        string $password
    ) {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new DBconnect(
                    dsn: $dsn,
                    username: $username,
                    password: $password
                );
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }
        return self::$instance;
    }
}
