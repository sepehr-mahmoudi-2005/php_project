<?php

$pdo = null;

list($host, $dbname, $username, $password) = [
    'localhost',
    'php_project',
    'root',
    ''
];

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
];

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $username,
        $password,
        $options
    );

    return $pdo;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
