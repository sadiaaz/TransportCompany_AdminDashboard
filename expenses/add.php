<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$shipments = $pdo->query("SELECT id FROM shipments ORDER BY id DESC")->fetchAll();
$accounts  = $pdo->query("SELECT id, account_name FROM accounts")->fetchAll();

/* TEMP: replace with session user id */
$created_by = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $shipment_id = $_POST['shipment_id'];
    $expense_type = trim($_POST['expense_type']);
    $amount = (float)$_POST['amount'];
    $account_id = $_POST['account_id'] ?: null;

    if ($shipment_id && $expense_type && $amount > 0) {
        $stmt = $pdo->prepare("
            INSERT INTO expenses
            (shipment_id, expense_type, amount, account_id, created_by)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $shipment_id,
            $expense_type,
            $amount,
            $account_id,
            $created_by
        ]);

        header("Location: /transport/expenses/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <h4>Add Expense</h4>

    <form method="POST" class="row g-3">

        <div class="col-md-3">
            <label class="form-label">Shipment</label>
            <select name="shipment_id" class="form-select" required>
                <option value="">-- Select Shipment --</option>
                <?php foreach ($shipments as $s): ?>
                    <option value="<?= $s['id'] ?>">Shipment #<?= $s['id'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Expense Type</label>
            <input type="text" name="expense_type" class="form-control" placeholder="Fuel, Toll, Driver..." required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Account</label>
            <select name="account_id" class="form-select">
                <option value="">-- Select Account --</option>
                <?php foreach ($accounts as $a): ?>
                    <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['account_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="col-12">
            <button class="btn btn-primary">Save Expense</button>
            <a href="/transport/expenses/list.php" class="btn btn-secondary">Back</a>
        </div>

    </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
