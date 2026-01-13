<?php
require "db.php";

// Fetch vehicles
$stmt = $pdo->query("SELECT * FROM vehicles ORDER BY id DESC");
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle List — Transport System</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h4 class="mb-4">Vehicles List</h4>

  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Number Plate</th>
          <th>Model</th>
          <th>Capacity</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($vehicles): ?>
          <?php foreach ($vehicles as $vehicle): ?>
            <tr>
              <td><?= htmlspecialchars($vehicle['id']) ?></td>
              <td><?= htmlspecialchars($vehicle['number_plate']) ?></td>
              <td><?= htmlspecialchars($vehicle['model']) ?></td>
              <td><?= htmlspecialchars($vehicle['capacity']) ?></td>
              <td>
                <a href="edit_vehicle.php?id=<?= $vehicle['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="delete_vehicle.php?id=<?= $vehicle['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center">No vehicles found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    <a href="add_vehicle.php" class="btn btn-success">Add New Vehicle</a>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
