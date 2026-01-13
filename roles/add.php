<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_name = trim($_POST['role_name']);

    if ($role_name !== '') {
        $stmt = $pdo->prepare("INSERT INTO roles (role_name) VALUES (?)");
        $stmt->execute([$role_name]);

        header("Location: /transport/roles/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <h4>Add Role</h4>

    <form method="POST" class="mt-3" style="max-width:400px;">
        <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" name="role_name" class="form-control" required>
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="/transport/roles/list.php" class="btn btn-secondary">Back</a>
    </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
