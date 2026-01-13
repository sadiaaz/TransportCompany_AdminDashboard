<?php
require "db.php";

// Fetch shipment records with related vehicle info
$stmt = $pdo->query("
  SELECT s.id, v.number_plate, s.date, s.items, s.income, s.expenses
  FROM shipments s
  JOIN vehicles v ON s.vehicle_id = v.id
  ORDER BY s.date DESC
");

$shipments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipment List — Transport System</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h4 class="mb-4">Shipments List</h4>

  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Vehicle</th>
          <th>Date</th>
          <th>Items</th>
          <th>Income (PKR)</th>
          <th>Expenses (PKR)</th>
          <th>Net (PKR)</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($shipments): ?>
          <?php foreach ($shipments as $row): ?>
            <?php
              // Calculate net profit/loss for this shipment
              $net = $row['income'] - $row['expenses'];
            ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['number_plate']) ?></td>
              <td><?= htmlspecialchars($row['date']) ?></td>
              <td><?= htmlspecialchars($row['items']) ?></td>
              <td><?= number_format($row['income'], 2) ?></td>
              <td><?= number_format($row['expenses'], 2) ?></td>
              <td><?= number_format($net, 2) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="text-center">No shipments found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    <a href="add_shipment_form.php" class="btn btn-success">Add Shipment</a>
  </div>

</div>

<!-- Optional Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
