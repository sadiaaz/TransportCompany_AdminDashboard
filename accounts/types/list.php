<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$types = $pdo->query("
    SELECT * FROM account_types ORDER BY id DESC
")->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Account Types</h4>
        <a href="/transport/accounts/types/add.php" class="btn btn-sm btn-success">Add Type</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Type Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($types): ?>
                <?php foreach ($types as $type): ?>
                    <tr>
                        <td><?= $type['id'] ?></td>
                        <td><?= htmlspecialchars($type['type_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center">No account types found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
