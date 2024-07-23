<?= $this->extend('Layouts/Layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
            <h4 class="mb-sm-0">List Mahasiswa</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">List Mahasiswa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<body>
    <!-- <h1>Users</h1> -->

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $user['nama'] ?></td>
                    <td>
                        <a href="<?= site_url('payment/userPayments/' . $user['id']) ?>">Manage Payments</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= site_url('payment/addInvoice') ?>">Add Invoice</a>
</body>



<?= $this->endSection() ?>

<script>
document.getElementById('foto').addEventListener('change', function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var imgElement = document.getElementById('user-foto');
        imgElement.src = reader.result;
    }
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
});
</script>
