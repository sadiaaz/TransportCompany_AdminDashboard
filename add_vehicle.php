<?php
require "db.php";

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number_plate = trim($_POST['number_plate']);
    $model = trim($_POST['model']);
    $capacity = intval($_POST['capacity']);

    if ($number_plate && $model && $capacity > 0) {
        $stmt = $pdo->prepare("INSERT INTO vehicles (number_plate, model, capacity) VALUES (?, ?, ?)");
        $success = $stmt->execute([$number_plate, $model, $capacity]);

        if ($success) {
            $message = "Vehicle added successfully!";
        } else {
            $message = "Error: Could not add vehicle.";
        }
    } else {
        $message = "Please fill in all fields correctly.";
    }
}
?>
<!-- Vehicle Code -->

new
<!-- vehicle carried date itmes -->
 <!-- vehicle code  -->
  <!--  -->

  name company amount borrow amount given #f4f6f9 expense 
  

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle — Transport System</title>

    <!-- Bootstrap CSS (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 40px;
        }
        .card {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card bg-white">
        <h4 class="mb-3 text-center">Add New Vehicle</h4>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form action="add_vehicle.php" method="POST">
            <div class="mb-3">
                <label for="number_plate" class="form-label">Number Plate</label>
                <input type="text" id="number_plate" name="number_plate" class="form-control" placeholder="Enter vehicle number plate" required>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" id="model" name="model" class="form-control" placeholder="Enter vehicle model" required>
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" id="capacity" name="capacity" class="form-control" placeholder="Enter seating/weight capacity" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Add Vehicle</button>
        </form>

        <div class="mt-3 text-center">
            <a href="dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
    </div>
</div>

<!-- Optional Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
