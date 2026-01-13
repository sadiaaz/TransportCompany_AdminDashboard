<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shipment — Transport System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 650px;
            margin-top: 40px;
        }
        .card {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card bg-white">
        <h4 class="mb-3 text-center">Add New Shipment</h4>

        <form action="add_shipment.php" method="POST">

            <?php
            require "db.php";
            $stmt = $pdo->query("SELECT id, number_plate FROM vehicles ORDER BY number_plate");
            $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <!-- Vehicle -->
            <label class="form-label">Select Vehicle</label>
            <select name="vehicle_id" class="form-control mb-3" required>
                <option value="">-- Choose Vehicle --</option>
                <?php foreach ($vehicles as $v): ?>
                    <option value="<?= htmlspecialchars($v['id']) ?>">
                        <?= htmlspecialchars($v['number_plate']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Date -->
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control mb-3" required>

            <!-- Items Name -->
            <label class="form-label">Items Description</label>
            <input type="text" name="items" class="form-control mb-3"
                   placeholder="e.g. Furniture, Goods" required>

            <!-- Boxes -->
            <label class="form-label">Total Boxes</label>
            <input type="number" id="boxes" name="boxes" class="form-control mb-3" required>

            <!-- Items per box -->
            <label class="form-label">Items per Box</label>
            <input type="number" id="items_per_box" name="items_per_box" class="form-control mb-3" required>

            <!-- Total items -->
            <label class="form-label">Total Items</label>
            <input type="number" id="total_items" name="total_items"
                   class="form-control mb-3" readonly>

            <!-- Price per piece -->
            <label class="form-label">Price per Piece (PKR)</label>
            <input type="number" step="0.01" id="price_per_piece"
                   name="price_per_piece" class="form-control mb-3" required>

            <!-- Total price -->
            <label class="form-label">Total Price (PKR)</label>
            <input type="number" step="0.01" id="total_price"
                   name="total_price" class="form-control mb-3" readonly>

            <!-- Income -->
            <label class="form-label">Income (PKR)</label>
            <input type="number" step="0.01" name="income" class="form-control mb-3" required>

            <!-- Expenses -->
            <label class="form-label">Expenses (PKR)</label>
            <input type="number" step="0.01" name="expenses" class="form-control mb-4" required>

            <button type="submit" class="btn btn-primary w-100">Add Shipment</button>
        </form>

        <div class="mt-3 text-center">
            <a href="list_shipments.php" class="btn btn-outline-secondary">View All Shipments</a>
        </div>
    </div>
</div>

<script>
function calculateTotals() {
    const boxes = parseInt(document.getElementById('boxes').value) || 0;
    const itemsPerBox = parseInt(document.getElementById('items_per_box').value) || 0;
    const price = parseFloat(document.getElementById('price_per_piece').value) || 0;

    const totalItems = boxes * itemsPerBox;
    const totalPrice = totalItems * price;

    document.getElementById('total_items').value = totalItems;
    document.getElementById('total_price').value = totalPrice.toFixed(2);
}

['boxes', 'items_per_box', 'price_per_piece'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateTotals);
});
</script>

</body>
</html>
