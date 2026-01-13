<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$types = $pdo->query(
    "SELECT * FROM vehicle_types ORDER BY id DESC"
)->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Vehicle Types</h3>
        <a href="add.php" class="btn btn-dark">+ Add Type</a>
    </div>

    <div class="card shadow-sm">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type Name</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($types): ?>
                <?php foreach ($types as $t): ?>
                    <tr>
                        <td><?= $t['id'] ?></td>
                        <td><?= htmlspecialchars($t['type_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center py-3">No types found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
