<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$accounts = $pdo->query("
    SELECT accounts.*, account_types.type_name
    FROM accounts
    LEFT JOIN account_types ON accounts.account_type_id = account_types.id
    ORDER BY accounts.id DESC
")->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Accounts</h4>
        <a href="/transport/accounts/add.php" class="btn btn-sm btn-success">Add Account</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Account Name</th>
                <th>Type</th>
                <th>Balance</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($accounts): ?>
                <?php foreach ($accounts as $acc): ?>
                    <tr>
                        <td><?= $acc['id'] ?></td>
                        <td><?= htmlspecialchars($acc['account_name']) ?></td>
                        <td><?= $acc['type_name'] ?? '—' ?></td>
                        <td>Rs. <?= number_format($acc['balance'], 2) ?></td>
                        <td><?= $acc['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No accounts found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
