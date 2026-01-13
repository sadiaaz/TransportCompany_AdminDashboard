<?php
$host = "localhost";
$dbname = "transport_db";
$user = "root";
$pass = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    echo "Database connected successfully";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
