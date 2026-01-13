<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";

// Safe helper to get counts / sums
function safeQuery($pdo, $sql) {
    try {
        $result = $pdo->query($sql);
        return $result ? $result->fetchColumn() : 0;
    } catch (PDOException $e) {
        return 0; // fallback if table/column doesn't exist
    }
}

// Stats
$totalVehicles = safeQuery($pdo, "SELECT COUNT(*) FROM vehicles");
$activeShipments = safeQuery($pdo, "SELECT COUNT(*) FROM shipments");
$totalIncome = safeQuery($pdo, "SELECT SUM(total_price) FROM shipments");
$totalExpenses = safeQuery($pdo, "SELECT SUM(amount) FROM expenses");
$totalProfit = $totalIncome - $totalExpenses;

// Vehicle availability
// Vehicle availability ✅ CORRECT
$vehicleAvailable = safeQuery(
    $pdo,
    "SELECT COUNT(*) FROM vehicles WHERE vehicle_status_id = 2"
);

$vehicleOnTrip = safeQuery(
    $pdo,
    "SELECT COUNT(*) FROM vehicles WHERE vehicle_status_id = 3"
);

$vehicleMaintenance = safeQuery(
    $pdo,
    "SELECT COUNT(*) FROM vehicles WHERE vehicle_status_id = 1"
);

// Recent Transactions
try {
    $recentTransactions = $pdo->query("
        SELECT e.id, e.amount, c.company_name
        FROM expenses e
        LEFT JOIN shipments s ON e.shipment_id = s.id
        LEFT JOIN companies c ON s.company_id = c.id
        ORDER BY e.created_at DESC
        LIMIT 5
    ")->fetchAll();
} catch (PDOException $e) {
    $recentTransactions = [];
}
?>

<main class="content  mt-4">

    <h3 class="mb-4">Dashboard Overview</h3>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card p-3 bg-light rounded shadow-sm">
                <small class="text-muted">Total Vehicles</small>
                <h4><?= $totalVehicles ?></h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card p-3 bg-light rounded shadow-sm">
                <small class="text-muted">Active Shipments</small>
                <h4><?= $activeShipments ?></h4>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card p-3 bg-light rounded shadow-sm">
                <small class="text-muted">Income</small>
                <h5>Rs. <?= number_format($totalIncome, 2) ?></h5>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card p-3 bg-light rounded shadow-sm">
                <small class="text-muted">Expenses</small>
                <h5>Rs. <?= number_format($totalExpenses, 2) ?></h5>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card p-3 bg-light rounded shadow-sm">
                <small class="text-muted">Profit</small>
                <h5>Rs. <?= number_format($totalProfit, 2) ?></h5>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h5>Income vs Expenses vs Profit</h5>
                <canvas id="barChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h5>Vehicle Usage</h5>
                <canvas id="pieChart" ></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="card p-3 bg-white rounded shadow-sm">
        <h5 class="mb-3">Recent Expenses</h5>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Amount (Rs.)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($recentTransactions): ?>
                    <?php foreach ($recentTransactions as $t): ?>
                        <tr>
                            <td>#<?= $t['id'] ?></td>
                            <td><?= htmlspecialchars($t['company_name'] ?? '-') ?></td>
                            <td><?= number_format($t['amount'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No recent transactions</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Income', 'Expenses', 'Profit'],
        datasets: [{
            data: [<?= $totalIncome ?>, <?= $totalExpenses ?>, <?= $totalProfit ?>],
            backgroundColor: ['#28a745','#dc3545','#007bff']
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
});



const pieCtx = document.getElementById('pieChart').getContext('2d');

new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Available', 'On Trip', 'Under Maintenance'],
        datasets: [{
            data: [
                <?= $vehicleAvailable ?>,
                <?= $vehicleOnTrip ?>,
                <?= $vehicleMaintenance ?>
            ],
            backgroundColor: ['#28a745', '#dc3545', '#ffc107']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});


</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
