<?php
require_once __DIR__ . '/env.php';

function getPDO(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        loadEnv(__DIR__ . '/../../.env');

        $host    = getenv('DB_HOST');
        $db      = getenv('DB_NAME');
        $user    = getenv('DB_USER');
        $pass    = getenv('DB_PASSWORD');
        $charset = getenv('DB_CHARSET') ?: 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
    }

    return $pdo;
}
