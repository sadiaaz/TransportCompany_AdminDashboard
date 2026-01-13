<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";

$statuses = $pdo->query("
    SELECT * FROM shipment_statuses
    ORDER BY id DESC
")->fetchAll();
?>

<main class="content mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Shipment Status List</h4>
        <a href="add.php" class="btn btn-dark">+ Add Status</a>
    </div>

    <div class="card p-3 shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Color</th>
                    <th>Preview</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statuses as $s): ?>
                    <tr>
                        <td><?= $s['id'] ?></td>
                        <td><?= htmlspecialchars($s['status_name']) ?></td>
                        <td><?= $s['color_code'] ?></td>
                        <td>
                            <span class="badge"
                                  style="background: <?= $s['color_code'] ?>;">
                                <?= $s['status_name'] ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (!$statuses): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No shipment statuses found
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
