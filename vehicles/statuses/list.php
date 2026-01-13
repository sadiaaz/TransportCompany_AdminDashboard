<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$statuses = $pdo->query(
    "SELECT * FROM vehicle_statuses ORDER BY id DESC"
)->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Vehicle Statuses</h3>
        <a href="add.php" class="btn btn-dark">+ Add Status</a>
    </div>

    <div class="card shadow-sm">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status Name</th>
                    <th>Color</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($statuses): ?>
                <?php foreach ($statuses as $s): ?>
                    <tr>
                        <td><?= $s['id'] ?></td>
                        <td><?= htmlspecialchars($s['status_name']) ?></td>
                        <td>
                            <span class="badge"
                                  style="background:<?= $s['color_code'] ?>;">
                                <?= $s['color_code'] ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center py-3">No statuses found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
