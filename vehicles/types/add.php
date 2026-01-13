<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $type_name = trim($_POST['type_name']);

    if ($type_name) {
        $stmt = $pdo->prepare(
            "INSERT INTO vehicle_types (type_name) VALUES (?)"
        );
        $stmt->execute([$type_name]);

        header("Location: /transport/vehicles/types/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">

    <h3 class="mb-4">Add Vehicle Type</h3>

    <form method="POST" class="card p-4 shadow-sm" style="max-width:500px;">
        <div class="mb-3">
            <label class="form-label">Type Name</label>
            <input type="text" name="type_name" class="form-control" required>
        </div>

        <button class="btn btn-dark">Save</button>
        <a href="list.php" class="btn btn-secondary ms-2">Back</a>
    </form>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
