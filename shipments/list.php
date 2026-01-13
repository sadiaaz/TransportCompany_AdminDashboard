<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$search = $_GET['search'] ?? '';

$sql = "
    SELECT s.*, 
           v.vehicle_code,
           c.company_name,
           i.item_name,
           u.name AS created_by_name
    FROM shipments s
    LEFT JOIN vehicles v ON s.vehicle_id = v.id
    LEFT JOIN companies c ON s.company_id = c.id
    LEFT JOIN items i ON s.item_id = i.id
    LEFT JOIN users u ON s.created_by = u.id
";

$params = [];

if (!empty($search)) {
    $sql .= "
        WHERE 
            v.vehicle_code LIKE :vehicle_search OR
            c.company_name LIKE :company_search OR
            i.item_name LIKE :item_search
    ";

    $params = [
        'vehicle_search' => "%$search%",
        'company_search' => "%$search%",
        'item_search'    => "%$search%",
    ];
}


$sql .= " ORDER BY s.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$shipments = $stmt->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>


<main class="content container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Shipments</h4>
        <a href="/transport/shipments/add.php" class="btn btn-sm btn-success">Add Shipment</a>
    </div>
    <form method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <input 
            type="text" 
            name="search" 
            class="form-control form-control-sm"
            placeholder="Search by Vehicle, Company, Item"
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
        >
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-sm btn-primary">
            Search
        </button>
        <a href="index.php" class="btn btn-sm btn-secondary">
            Reset
        </a>
    </div>
</form>
 

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Vehicle</th>
                <th>Company</th>
                <th>Item</th>
                <th>Total Items</th>
                <th>Total Price</th>
                <th>Actions</th>

                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($shipments): ?>
                <?php foreach ($shipments as $s): ?>
                    <tr>
                        <td><?= $s['id'] ?></td>
                        <td><?= $s['shipment_date'] ?></td>
                        <td><?= $s['vehicle_code'] ?? '—' ?></td>
                        <td><?= $s['company_name'] ?? '—' ?></td>
                        <td><?= $s['item_name'] ?? '—' ?></td>
                        <td><?= $s['total_items'] ?></td>
                        <td>Rs. <?= number_format($s['total_price'], 2) ?></td>
                        <td><?= $s['created_by_name'] ?? '—' ?></td>
                        <td>
    <a href="/transport/shipments/edit.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
    <a href="/transport/shipments/delete.php?id=<?= $s['id'] ?>"
       class="btn btn-sm btn-danger"
       onclick="return confirm('Delete this shipment?')">
       Delete
    </a>
</td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No shipments found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
