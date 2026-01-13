<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $item_name = trim($_POST['item_name']);
    $category = trim($_POST['category']);

    if ($item_name && $category) {
        $stmt = $pdo->prepare(
            "INSERT INTO items (item_name, category, created_at)
             VALUES (?, ?, NOW())"
        );
        $stmt->execute([$item_name, $category]);

        // ✅ Redirect BEFORE any output
        header("Location: /transport/items/list.php");
        exit;
    }
}

// Only after logic — include layout
include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>



<main class="content container mt-4">

    <h3 class="mb-4">Add Item</h3>

    <form method="POST" class="card p-4 shadow-sm" style="max-width:500px;">
        <div class="mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>

        <button class="btn btn-dark">Save Item</button>
        <a href="list.php" class="btn btn-secondary ms-2">Back</a>
    </form>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
