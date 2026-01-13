<?php
require "db.php";

$vehicle_id      = $_POST['vehicle_id'];
$date            = $_POST['date'];
$boxes           = $_POST['boxes'];
$items_per_box   = $_POST['items_per_box'];
$total_items     = $boxes * $items_per_box; // safety calculation
$price_per_piece = $_POST['price_per_piece'];
$total_price     = $total_items * $price_per_piece;
$income          = $_POST['income'];
$expenses        = $_POST['expenses'];

$stmt = $pdo->prepare("
  INSERT INTO shipments 
  (vehicle_id, date, boxes, items_per_box, total_items, price_per_piece, total_price, income, expenses)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$success = $stmt->execute([
  $vehicle_id,
  $date,
  $boxes,
  $items_per_box,
  $total_items,
  $price_per_piece,
  $total_price,
  $income,
  $expenses
]);

if ($success === true) {
    header("Location: dashboard.php");
    exit;
} else {
    echo json_encode(["success" => false]);
}

?>
