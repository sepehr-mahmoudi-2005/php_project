<?php

const PDO_OPTIONS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
];

function connect(
    string $host,
    string $dbname,
    string $username,
    string $password
): PDO {
    try {
        return new PDO(
            "mysql:host=$host;dbname=$dbname",
            $username,
            $password,
            PDO_OPTIONS
        );
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}
