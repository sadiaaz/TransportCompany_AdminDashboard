<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

/* Fetch dropdown data */
$types = $pdo->query("SELECT id, type_name FROM vehicle_types ORDER BY type_name")->fetchAll();
$statuses = $pdo->query("SELECT id, status_name FROM vehicle_statuses ORDER BY status_name")->fetchAll();

/* Handle submit */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vehicle_code = trim($_POST['vehicle_code']);
    $number_plate = trim($_POST['number_plate']);
    $vehicle_type_id = $_POST['vehicle_type_id'] ?: null;
    $vehicle_status_id = $_POST['vehicle_status_id'] ?: null;
    $capacity = $_POST['capacity'] ?: null;

    if ($vehicle_code && $number_plate) {
        $stmt = $pdo->prepare("
            INSERT INTO vehicles 
            (vehicle_code, number_plate, vehicle_type_id, vehicle_status_id, capacity)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $vehicle_code,
            $number_plate,
            $vehicle_type_id,
            $vehicle_status_id,
            $capacity
        ]);

        header("Location: /transport/vehicles/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">

    <h3 class="mb-4">Add Vehicle</h3>

    <form method="POST" class="card p-4 shadow-sm" style="max-width:600px;">

        <div class="mb-3">
            <label class="form-label">Vehicle Code</label>
            <input type="text" name="vehicle_code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Number Plate</label>
            <input type="text" name="number_plate" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Vehicle Type</label>
            <select name="vehicle_type_id" class="form-select">
                <option value="">Select Type</option>
                <?php foreach ($types as $t): ?>
                    <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['type_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Vehicle Status</label>
            <select name="vehicle_status_id" class="form-select">
                <option value="">Select Status</option>
                <?php foreach ($statuses as $s): ?>
                    <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['status_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" placeholder="e.g. 5000">
        </div>

        <button class="btn btn-dark">Save Vehicle</button>
        <a href="list.php" class="btn btn-secondary ms-2">Back</a>

    </form>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
