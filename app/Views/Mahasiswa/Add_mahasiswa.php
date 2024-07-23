<?= $this->extend('Layouts/Layout') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
            <h4 class="mb-sm-0">Tambah Data Mahasiswa</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">List Mahasiswa</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            Tambah Data Siswa
                        </div>
                        <div class="card-body">

                        <?php if(session()->has('errors')): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach(session('errors') as $error): ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?> 
                        <form action="/add_user_mahasiswa" method="post">
                        <?= csrf_field() ?>

                                <div class="mb-3 row">
                                    <label for="nim" class="col-sm-2 col-form-label">Nim</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nim" id="nim" placeholder="nim" required>
                                    </div>
                                </div>
            
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="jenis_kelamin" id="flexRadioDefault1" required value="Pria">
                                            <label class="custom-control-label" for="flexRadioDefault1">Laki - Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="jenis_kelamin" id="flexRadioDefault2" required value="Wanita">
                                            <label class="custom-control-label" for="flexRadioDefault2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" aria-label="Default select example" required name="agama" id="agama">
                                            <option value="" disabled selected>Pilih Agama</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="id_semester" class="col-sm-2 col-form-label">Semester</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" aria-label="Default select example" required name="id_semester" id="id_semester">
                                            <option value="">Pilih Semester</option>
                                            <?php foreach ($semester as $data): ?>
                                                <option value="<?= $data->id_semester; ?>"><?= $data->semester; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="prodi" class="col-sm-2 col-form-label">Pilih prodi</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" aria-label="Default select example" required name="prodi" id="prodi">
                                            <option value="">Pilih Prodi</option>
                                            <option value="Teknik Informatika">Teknik Informatika</option>
                                            <option value="Sistem Informasi">Sistem Informasi</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="status" class="col-sm-2 col-form-label">Pilih status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" aria-label="Default select example" required name="status">
                                            <option value="Wisuda" disabled>Wisuda</option>
                                            <option value="Belum Wisuda" selected>Belum Wisuda</option>
                                            <option value="Pindah" disabled>Pindah</option>   
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama_wali" class="col-sm-2 col-form-label">Nama Wali</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Nama Wali" required>
                                    </div>
                                </div>
                                

                                <div class="mb-3 row">
                                    <label for="no_handphone" class="col-sm-2 col-form-label">No Hp / Wa</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_handphone" name="no_handphone" placeholder="No Hp / No WA" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea id="alamat" class="form-control" name="alamat" rows="2" placeholder="Alamat Lengkap, Meliputi RT/RW" required></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">   
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password-input" value="admin123">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                    </div>
                                </div>
                                    <div class="float-right">
                                        <input type="submit" value="submit" class="btn btn-primary">
                                        </input>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?= $this->endSection('content') ?>
