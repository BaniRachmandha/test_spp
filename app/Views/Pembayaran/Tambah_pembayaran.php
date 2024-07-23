<!DOCTYPE html>
<html>
<head>
    <title>Select User for Payment</title>
</head>
<body>
    <h1>Select User</h1>
    <form method="post" action="<?= site_url('payment/selectUser') ?>">
        <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>"><?= $user['nama'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Select</button>
    </form>
    <a href="<?= site_url('payment') ?>">Back to Users</a>
</body>
</html>
