<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type_name = trim($_POST['type_name']);

    if ($type_name) {
        $stmt = $pdo->prepare("
            INSERT INTO account_types (type_name)
            VALUES (?)
        ");
        $stmt->execute([$type_name]);

        header("Location: /transport/accounts/types/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <h4>Add Account Type</h4>

    <form method="POST" class="mt-3" style="max-width:400px;">
        <div class="mb-3">
            <label class="form-label">Type Name</label>
            <input type="text" name="type_name" class="form-control" required>
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="/transport/accounts/types/list.php" class="btn btn-secondary">Back</a>
    </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
