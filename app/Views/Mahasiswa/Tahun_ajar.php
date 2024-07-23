<?= $this->extend('Layouts/Layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
            <h4 class="mb-sm-0">Manajemen Tahun Ajaran</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manajemen Tahun Ajaran</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" style="float: right;" href="<?php echo base_url('/tambah_ajaran') ?>" role="button">Tambah Tahun Ajaran</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="TahunAjaran">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="ce">Aktif</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; foreach ($tahun_ajar as $data): ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $data->tahun_ajaran ?></td>
                              <?php if($data->status_tahun_ajar == 'Aktif'){ ?>
                              <td class="text-center"><a><span class="badge badge-success"><i class=" ri-check-fill"></i></span></a></td>
                              <?php }else{ ?>
                              <td class="text-center"><a><span class="badge badge-danger"><i class=" ri-close-fill"></i></span></a></td>
                              <?php } ?>
                              <td><center><a onclick="return confirm('Yakin Mau Menghapus Data Ini ? ')" href="<?php echo base_url('/delete_tahun/'.$data->id) ?>"><span class="badge badge-danger"><i class="ri-close-fill"></i></span></a> 
                              <a href="<?php echo base_url('/edit_tahun_page/'.$data->id) ?>"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a></center></td>

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



<?= $this->endSection('content') ?>