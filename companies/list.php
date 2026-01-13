<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

$companies = $pdo->query("
    SELECT * FROM companies ORDER BY id DESC
")->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Companies</h4>
        <a href="/transport/companies/add.php" class="btn btn-sm btn-success">Add Company</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Company</th>
                <th>Contact Person</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($companies): ?>
                <?php foreach ($companies as $company): ?>
                    <tr>
                        <td><?= $company['id'] ?></td>
                        <td><?= htmlspecialchars($company['company_name']) ?></td>
                        <td><?= htmlspecialchars($company['contact_person']) ?></td>
                        <td><?= htmlspecialchars($company['phone']) ?></td>
                        <td><?= htmlspecialchars($company['address']) ?></td>
                        <td><?= $company['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No companies found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
