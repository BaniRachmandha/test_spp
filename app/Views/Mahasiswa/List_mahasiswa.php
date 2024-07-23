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
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                  Manajemen Data Mahasiswa 
                </div>
                <div class="card-header" style="background-color: #f9f9f9;">

                <div class="row">
                      <div class="col-sm-3 mt-2 mb-2">
                      <form action="<?php echo base_url('admin/datasiswa') ?>" method="GET">
                        <?php if(isset($_GET['status'])){ ?>
                          <select class="form-control" required name="status">
                            <option  value="">- Semua Status -</option>

                            <?php if($_GET['status'] == "L"){ ?>
                            <option value="L" selected>Lulus</option>
                            <?php }else{ ?>
                            <option value="L">Lulus</option>
                            <?php } ?>

                            <?php if($_GET['status'] == "T"){ ?>
                            <option value="T" selected>Belum Lulus</option>
                            <?php }else{ ?>
                            <option value="T">Belum Lulus</option>
                            <?php } ?>

                            <?php if($_GET['status'] == "P"){ ?>
                            <option value="P" selected>Pindah</option>
                            <?php }else{ ?>
                            <option value="P">Pindah</option>
                            <?php } ?>
                          </select>
                        <?php }else{ ?>
                          <select class="form-control" required name="status">
                            <option  value="">- Semua Status -</option>
                            <option value="Wisuda">Lulus</option>
                            <option value="Belum Wisuda">Belum Wisuda</option>
                            <option value="Pindah">Pindah</option>
                          </select>
                        <?php } ?>
                      </div>

                      <div class="col-sm-3 mt-2 mb-2">
                          <select class="form-control" required name="kelas">
                            <option  value="">- Pilih Kelas -</option>

                          </select>
                      </div>
                      <div class="col-sm-1 mt-2 mb-2">
                        <button type="submit" class="btn btn-info">Tampilkan</button>
                      </div>
                    </form>
                      <div class="col-sm-5 mt-2">
                        <a style="float:right" class="btn btn-primary" href="<?php echo base_url('/add_mahasiswa') ?>" role="button">Tambah Siswa</a> <a style="float:right; margin-right:5px;" class="btn btn-success"  data-toggle="modal" data-target="#modal-default" role="button">Import Excle</a>
                      </div>
                  </div>

                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped" id="DataSiswa">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">No Hp</th>
                            <th scope="col" style="width:10px;">Aksi</th>
                            <th scope="col">Cek Tagihan</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; foreach($mahasiswa as $data): ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $data->nim ?></td>
                                <td><?php echo $data->nama ?></td>
                                <td><?php echo $data->jenis_kelamin ?></td>
                                <td><?php echo $data->semester ?></td>
                                <td><?php echo $data->prodi ?></td>
                                <td><?php echo $data->no_handphone ?></td>
                                
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

      </div>
    </section>
  </div>

  
<?= $this->endSection('content') ?>