<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$vehicles = $pdo->query("
    SELECT 
        v.id,
        v.vehicle_code,
        v.number_plate,
        v.capacity,
        v.created_at,
        vt.type_name,
        vs.status_name,
        vs.color_code
    FROM vehicles v
    LEFT JOIN vehicle_types vt ON v.vehicle_type_id = vt.id
    LEFT JOIN vehicle_statuses vs ON v.vehicle_status_id = vs.id
    ORDER BY v.id DESC
")->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Vehicles</h3>
        <a href="add.php" class="btn btn-dark">+ Add Vehicle</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Number Plate</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Capacity</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($vehicles): ?>
                    <?php foreach ($vehicles as $v): ?>
                        <tr>
                            <td><?= $v['id'] ?></td>
                            <td><?= htmlspecialchars($v['vehicle_code']) ?></td>
                            <td><?= htmlspecialchars($v['number_plate']) ?></td>
                            <td><?= $v['type_name'] ?? '-' ?></td>
                            <td>
                                <?php if ($v['status_name']): ?>
                                    <span class="badge"
                                          style="background:<?= $v['color_code'] ?>;">
                                        <?= htmlspecialchars($v['status_name']) ?>
                                    </span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= $v['capacity'] ?? '-' ?></td>
                            <td><?= date("d M Y", strtotime($v['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-3">No vehicles found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
