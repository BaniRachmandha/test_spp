<!DOCTYPE html>
<html>
<head>
    <title>User Payments</title>
</head>
<body>
    <h1>Payments for <?= $user['nama'] ?></h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Semester</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $index => $invoice): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $invoice['semester'] ?></td>
                    <td><?= $invoice['amount'] ?></td>
                    <td><?= $invoice['status'] ?></td>
                    <td><?= $invoice['due_date'] ?></td>
                    <td>
                        <form action="<?= site_url('payment/setInstallments/' . $invoice['id']) ?>" method="post">
                            <input type="number" name="installments" placeholder="Installments" min="1" max="6" required>
                            <button type="submit">Set Installments</button>
                        </form>
                        <br>
                        <a href="<?= site_url('payment/addPayment/' . $invoice['id']) ?>">Add Payment</a> |
                        <a href="<?= site_url('payment/payWithMidtrans/' . $invoice['id']) ?>">Pay with Midtrans</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= site_url('payment') ?>">Back to Users</a>
</body>
</html>
