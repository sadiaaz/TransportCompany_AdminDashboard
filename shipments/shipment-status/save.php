<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['status_name']);
    $color = $_POST['color_code'] ?: '#6c757d';

    if ($name !== '') {
        $stmt = $pdo->prepare("
            INSERT INTO shipment_statuses (status_name, color_code)
            VALUES (?, ?)
        ");
        $stmt->execute([$name, $color]);
    }
}

header("Location: list.php");
exit;
