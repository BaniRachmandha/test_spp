<?= $this->include('Layouts/header') ?>
<?= $this->include('Layouts/sidebar_menu') ?>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<!-- Start right Content here -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <?= $this->renderSection('content') ?>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content-->
<?= $this->include('Layouts/footer') ?>
<?= $this->include('Layouts/js') ?>