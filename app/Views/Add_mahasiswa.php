<?= $this->extend('Layouts/Layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
            <h4 class="mb-sm-0">Add Mahasiswa</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Add User</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<head>
  
</head>
<body>
    <?php if(session()->get('errors')): ?>
        <ul>
            <?php foreach(session()->get('errors') as $error):?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

<form action="<?= base_url('/add_Mahasiswa') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?> 

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" id="nama">
            </div>
        </div><!--end col-->
        <div class="col-6">
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select form-select  mb-3" name="jenis_kelamin" id="jenis_kelamin" aria-label=".form-select-sm example">
                    <option selected disabled>Pilih Jenis Kelamin</option>
                    <option value="Pria">Laki - Laki</option>
                    <option value="Wanita">Perempuan</option>
                </select>
            </div>
        </div><!--end col-->
        <div class="col-6">
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" id="alamat">
            </div>
        </div><!--end col-->
        <div class="col-6">
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor Handphone</label>
                <input type="number" name="no_hp" class="form-control" placeholder="Masukan No Handphone" id="no_hp">
            </div>
        </div><!--end col-->
        <div class="col-6">
            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <select class="form-select form-select  mb-3" name="semester" id="semester" aria-label=".form-select-sm example">
                    <option selected disabled>Pilih Semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
        </div>        
        <div class="col-6">
            <div class="mb-3">
                <label for="is_admin" class="form-label">Pilih Role</label>
                <select class="form-select form-select  mb-3" name="is_admin" id="is_admin" aria-label=".form-select-sm example">
                    <option selected disabled>Pilih Role</option>
                    <option value="1">Admin</option>
                    <option value="2">Mahasiswa</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir" id="tempat_lahir">
            </div>
        </div><!--end col-->
        <div class="col-6">
            <div class="mb-3">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir">
            </div>
        </div><!--end col-->
        <div class="col-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" id="email">
            </div>
        </div><!--end col-->
        <div class="col-6">
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="nim" name="nim" class="form-control" placeholder="Masukan NIM" id="nim">
            </div>
        </div><!--end col-->
        <div class="row">
            <div class="col-sm-4">
                <label>Foto User</label>
                <img id="user-foto" width="100px" src="default_image_path.jpg"> <!-- Default image path -->
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div><!--end col-->
    </div><!--end row-->
</form>

</body>
</html>

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
