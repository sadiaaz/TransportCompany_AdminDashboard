<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$expenses = $pdo->query("
    SELECT e.*, 
           a.account_name,
           u.name AS created_by_name
    FROM expenses e
    LEFT JOIN accounts a ON e.account_id = a.id
    LEFT JOIN users u ON e.created_by = u.id
    ORDER BY e.id DESC
")->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Expenses</h4>
        <a href="/transport/expenses/add.php" class="btn btn-sm btn-success">Add Expense</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Shipment</th>
                <th>Type</th>
                <th>Account</th>
                <th>Amount</th>
                <th>Created By</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($expenses): ?>
                <?php foreach ($expenses as $e): ?>
                    <tr>
                        <td><?= $e['id'] ?></td>
                        <td>#<?= $e['shipment_id'] ?></td>
                        <td><?= htmlspecialchars($e['expense_type']) ?></td>
                        <td><?= $e['account_name'] ?? '—' ?></td>
                        <td>Rs. <?= number_format($e['amount'], 2) ?></td>
                        <td><?= $e['created_by_name'] ?? '—' ?></td>
                        <td><?= $e['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No expenses found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
