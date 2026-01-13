<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $status_name = trim($_POST['status_name']);
    $color_code = $_POST['color_code'] ?: '#000000';

    if ($status_name) {
        $stmt = $pdo->prepare(
            "INSERT INTO vehicle_statuses (status_name, color_code)
             VALUES (?, ?)"
        );
        $stmt->execute([$status_name, $color_code]);

        header("Location: /transport/vehicles/statuses/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">

    <h3 class="mb-4">Add Vehicle Status</h3>

    <form method="POST" class="card p-4 shadow-sm" style="max-width:500px;">
        <div class="mb-3">
            <label class="form-label">Status Name</label>
            <input type="text" name="status_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Color Code</label>
            <input type="color" name="color_code" class="form-control form-control-color">
        </div>

        <button class="btn btn-dark">Save</button>
        <a href="list.php" class="btn btn-secondary ms-2">Back</a>
    </form>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
