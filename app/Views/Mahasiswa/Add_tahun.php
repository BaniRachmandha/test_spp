<?= $this->extend('Layouts/Layout') ?>

<?= $this->section('content') ?>

<section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                <div class="card-header">
                    Tambah Tahun Ajaran
                </div>
                <div class="card-body">
                    <form action="/tambah_ajaran_baru" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3 row">
                            <label for="tahun_lulus" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" required name="tahun_ajaran" placeholder="0000/9999">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span  role="status" aria-hidden="true"></span>
                            Simpan
                        </button>
                    </form>
                </div>
                </div>
            </div>
        </div>

      </div>
    </section>

    <?= $this->endSection('content') ?>