<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$roles = $pdo->query("SELECT * FROM roles ORDER BY id DESC")->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Roles</h4>
        <a href="/transport/roles/add.php" class="btn btn-sm btn-success">Add Role</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Role Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($roles): ?>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><?= $role['id'] ?></td>
                        <td><?= htmlspecialchars($role['role_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center">No roles found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
