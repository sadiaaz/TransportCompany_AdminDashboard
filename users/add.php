<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$roles = $pdo->query("SELECT * FROM roles")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id  = $_POST['role_id'] ?: null;

    if ($name && $email && $_POST['password']) {
        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, password, role_id)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$name, $email, $password, $role_id]);

        header("Location: /transport/users/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <h4>Add User</h4>

    <form method="POST" class="mt-3" style="max-width:500px;">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role_id" class="form-select">
                <option value="">-- Select Role --</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['id'] ?>">
                        <?= htmlspecialchars($role['role_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="/transport/users/list.php" class="btn btn-secondary">Back</a>
    </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
