<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content mt-4">
    <h4 class="mb-4">Add Shipment Status</h4>

    <form action="save.php" method="POST" class="card p-4 shadow-sm" style="max-width: 500px;">
        <div class="mb-3">
            <label class="form-label">Status Name</label>
            <input type="text" name="status_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Color Code</label>
            <input type="color" name="color_code" class="form-control form-control-color">
        </div>

        <button class="btn btn-dark">Save Status</button>
        <a href="list.php" class="btn btn-secondary ms-2">View List</a>
    </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
