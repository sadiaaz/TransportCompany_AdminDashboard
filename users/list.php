<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$users = $pdo->query("
    SELECT users.*, roles.role_name
    FROM users
    LEFT JOIN roles ON users.role_id = roles.id
    ORDER BY users.id DESC
")->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Users</h4>
        <a href="/transport/users/add.php" class="btn btn-sm btn-success">Add User</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($users): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= $user['role_name'] ?? '—' ?></td>
                        <td><?= $user['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No users found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
