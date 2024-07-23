<?= $this->extend('Layouts/Layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Kelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Data Kelas</li>
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
                    Manajemen Data Kelas <a style="float: right;" class="btn btn-primary" href="<?php echo base_url('admin/tambahkelas') ?>" role="button">Tambah Kelas</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="DataKelas">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($semester as $data): ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data->semester ?></td>
                                <td></td>
                                <td></td>
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
  <script>
    $(document).ready(function(){
        $('#DataKelas').DataTable();
    });
  </script>

<?= $this->endSection('content') ?>