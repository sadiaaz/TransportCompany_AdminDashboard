<?php
include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$items = $pdo->query(
    "SELECT * FROM items ORDER BY id DESC"
)->fetchAll();
?>

<main class="content container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Items List</h3>
        <a href="add.php" class="btn btn-dark">+ Add Item</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($items): ?>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= htmlspecialchars($item['item_name']) ?></td>
                                <td><?= htmlspecialchars($item['category']) ?></td>
                                <td><?= date("d M Y", strtotime($item['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-3">No items found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
