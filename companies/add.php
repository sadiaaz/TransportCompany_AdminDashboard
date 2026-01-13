<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company_name   = trim($_POST['company_name']);
    $contact_person = trim($_POST['contact_person']);
    $phone          = trim($_POST['phone']);
    $address        = trim($_POST['address']);

    if ($company_name) {
        $stmt = $pdo->prepare("
            INSERT INTO companies (company_name, contact_person, phone, address)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$company_name, $contact_person, $phone, $address]);

        header("Location: /transport/companies/list.php");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/header.php";
?>

<main class="content container mt-4">
    <h4>Add Company</h4>

    <form method="POST" class="mt-3" style="max-width:600px;">
        <div class="mb-3">
            <label class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact Person</label>
            <input type="text" name="contact_person" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="/transport/companies/list.php" class="btn btn-secondary">Back</a>
    </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/footer.php"; ?>
