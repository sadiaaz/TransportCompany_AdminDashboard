<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$id = $_GET['id'] ?? 0;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM shipments WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: /transport/shipments/list.php");
exit;
