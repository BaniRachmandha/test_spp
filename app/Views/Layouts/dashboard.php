<?= $this->extend('Layouts/Layout') ?>

<?= $this->section('content') ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
            <h4 class="mb-sm-0">Ecommerce</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Ecommerce</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Welcome, <?= session()->get('nama') ?>!</h4>
                            <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                        </div>
                        <div class="mt-3 mt-lg-0">
                            <form action="javascript:void(0);">
                                <div class="row g-3 mb-0 align-items-center">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-soft-primary"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card header -->
                </div>
            </div>
        </div> <!-- end .h-100-->
    </div> <!-- end col -->
</div>
<?= $this->endSection() ?>
