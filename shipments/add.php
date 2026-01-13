<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

/* Dropdown data */
$vehicles  = $pdo->query("SELECT id, vehicle_code FROM vehicles")->fetchAll();
$companies = $pdo->query("SELECT id, company_name FROM companies")->fetchAll();
$items     = $pdo->query("SELECT id, item_name FROM items")->fetchAll();

/* TEMP: replace with session user id later */
$created_by = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $shipment_date    = $_POST['shipment_date'];
    $vehicle_id       = $_POST['vehicle_id'] ?: null;
    $company_id       = $_POST['company_id'] ?: null;
    $item_id          = $_POST['item_id'] ?: null;
    $boxes            = (int)$_POST['boxes'];
    $items_per_box    = (int)$_POST['items_per_box'];
    $price_per_piece  = (float)$_POST['price_per_piece'];

    $total_items = $boxes * $items_per_box;
    $total_price = $total_items * $price_per_piece;

    if ($shipment_date) {
        $stmt = $pdo->prepare("
            INSERT INTO shipments
            (shipment_date, vehicle_id, company_id, item_id, boxes, items_per_box, total_items, price_per_piece, total_price, created_by)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $shipment_date,
            $vehicle_id,
            $company_id,
            $item_id,
            $boxes,
            $items_per_box,
            $total_items,
            $price_per_piece,
            $total_price,
            $created_by
        ]);

        header("Location: /transport/shipments/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <h4>Add Shipment</h4>

    <form method="POST" class="row g-3 mt-2">

        <div class="col-md-3">
            <label class="form-label">Shipment Date</label>
            <input type="date" name="shipment_date" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Vehicle</label>
            <select name="vehicle_id" class="form-select">
                <option value="">-- Select --</option>
                <?php foreach ($vehicles as $v): ?>
                    <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['vehicle_code']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Company</label>
            <select name="company_id" class="form-select">
                <option value="">-- Select --</option>
                <?php foreach ($companies as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['company_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Item</label>
            <select name="item_id" class="form-select">
                <option value="">-- Select --</option>
                <?php foreach ($items as $i): ?>
                    <option value="<?= $i['id'] ?>"><?= htmlspecialchars($i['item_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">Boxes</label>
            <input type="number" name="boxes" class="form-control" value="0">
        </div>

        <div class="col-md-2">
            <label class="form-label">Items / Box</label>
            <input type="number" name="items_per_box" class="form-control" value="0">
        </div>

        <div class="col-md-2">
            <label class="form-label">Price / Item</label>
            <input type="number" step="0.01" name="price_per_piece" class="form-control" value="0">
        </div>

        <div class="col-md-3">
    <label class="form-label">Total Items</label>
    <div class="form-control bg-light" id="total_items">0</div>
</div>

<div class="col-md-3">
    <label class="form-label">Total Price</label>
    <div class="form-control bg-light">Rs. <span id="total_price">0.00</span></div>
</div>
 

        <div class="col-12">
            <button class="btn btn-primary">Save Shipment</button>
            <a href="/transport/shipments/list.php" class="btn btn-secondary">Back</a>
        </div>

    </form>





    <script>
document.addEventListener("input", function () {
    const boxes = parseInt(document.querySelector('[name="boxes"]').value) || 0;
    const perBox = parseInt(document.querySelector('[name="items_per_box"]').value) || 0;
    const price = parseFloat(document.querySelector('[name="price_per_piece"]').value) || 0;

    const totalItems = boxes * perBox;
    const totalPrice = totalItems * price;

    document.getElementById("total_items").innerText = totalItems;
    document.getElementById("total_price").innerText = totalPrice.toFixed(2);
});
</script>
 
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
