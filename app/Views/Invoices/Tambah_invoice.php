<!DOCTYPE html>
<html>
<head>
    <title>Payment System</title>
</head>
<body>
    <h1>Add Invoice</h1>
    <form method="post" action="<?= site_url('payment/saveInvoice') ?>">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" id="user_id">
        <label for="semester">Semester:</label>
        <input type="text" name="semester" id="semester">
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount">
        <label for="due_date">Due Date:</label>
        <input type="text" name="due_date" id="due_date">
        <button type="submit">Add Invoice</button>
    </form>
    <a href="<?= site_url('payment') ?>">Back to Users</a>
</body>
</html>
