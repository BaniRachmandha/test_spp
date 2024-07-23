<!DOCTYPE html>
<html>
<head>
    <title>Payment System</title>
</head>
<body>
    <h1>Payments for <?= $user['nama'] ?></h1>
    <ul>
        <?php foreach ($invoices as $invoice): ?>
            <li>
                Semester: <?= $invoice['semester'] ?>,
                Amount: <?= $invoice['amount'] ?>,
                Due Date: <?= $invoice['due_date'] ?>,
                Status: <?= $invoice['status'] ?>
                <a href="<?= site_url('payment/addPayment/' . $invoice['id']) ?>">Add Payment</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="<?= site_url('payment') ?>">Back to Users</a>
</body>
</html>
