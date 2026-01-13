<?php
require "db.php";

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

$stmt = $pdo->prepare("
  SELECT SUM(income) AS total_income, SUM(expenses) AS total_expenses
  FROM shipments
  WHERE date BETWEEN ? AND ?
");
$stmt->execute([$start_date, $end_date]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$total_income = $result['total_income'];
$total_expenses = $result['total_expenses'];
$profit_loss = $total_income - $total_expenses;

echo json_encode([
  "total_income" => $total_income,
  "total_expenses" => $total_expenses,
  "profit_loss" => $profit_loss
]);
?>
