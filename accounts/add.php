<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$types = $pdo->query("SELECT * FROM account_types")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account_name    = trim($_POST['account_name']);
    $account_type_id = $_POST['account_type_id'] ?: null;
    $balance         = $_POST['balance'] ?? 0;

    if ($account_name) {
        $stmt = $pdo->prepare("
            INSERT INTO accounts (account_name, account_type_id, balance)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$account_name, $account_type_id, $balance]);

        header("Location: /transport/accounts/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <h4>Add Account</h4>

    <form method="POST" class="mt-3" style="max-width:500px;">
        <div class="mb-3">
            <label class="form-label">Account Name</label>
            <input type="text" name="account_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Account Type</label>
            <select name="account_type_id" class="form-select">
                <option value="">-- Select Type --</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type['id'] ?>">
                        <?= htmlspecialchars($type['type_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Opening Balance</label>
            <input type="number" step="0.01" name="balance" class="form-control" value="0">
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="/transport/accounts/list.php" class="btn btn-secondary">Back</a>
    </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
