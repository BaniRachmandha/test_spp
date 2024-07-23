<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Menu</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <!-- Include Bootstrap CSS if needed -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box bg-light">
            <!-- Dark Logo-->
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="<?php echo base_url() ?>assets/images/logo_usm.png" alt="" height="50">
                </span>
                <span class="logo-lg">
                    <img src="<?php echo base_url() ?>assets/images/banner_fik.png" alt="" height="52">
                </span>
            </a>
            <!-- Light Logo-->
            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="<?php echo base_url() ?>assets/images/logo_usm.png" alt="" height="50">
                </span>
                <span class="logo-lg">
                    <img src="<?php echo base_url() ?>assets/images/banner_fik.png" alt="" height="52">
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">
                <div id="two-column-menu"></div>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="index.html" class="nav-link" data-key="t-ecommerce"> Ecommerce </a>
                                </li>
                                <li class="nav-item">
                                    <a href="dashboard-projects.html" class="nav-link" data-key="t-projects"> Projects </a>
                                </li>
                                <li class="nav-item">
                                    <a href="dashboard-nft.html" class="nav-link" data-key="t-nft"> NFT</a>
                                </li>
                                <li class="nav-item">
                                    <a href="dashboard-job.html" class="nav-link" data-key="t-job">Job</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed active" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                            <i class="ri-apps-2-line"></i> <span data-key="t-apps">Master Data</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarApps">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="/tahun_ajaran" class="nav-link active">
                                        Tahun Ajaran
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/semester" class="nav-link active">
                                        Data Semester
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#sidebarPembayaran" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPembayaran" data-key="t-calender">
                                        Pembayaran
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarPembayaran">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="/pembayaran" class="nav-link" data-key="t-main-pembayaran"> Main Pembayaran </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="apps-Pembayaran-month-grid.html" class="nav-link" data-key="t-month-grid"> Month Grid </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="#sidebarMahasiswa" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMahasiswa" data-key="t-mahasiswa">
                                        Mahasiswa
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarMahasiswa">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="/list_pembayaran" class="nav-link" data-key="t-chat"> List Pembayaran </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/list_mahasiswa" class="nav-link active" data-key="t-chat"> List Mahasiswa </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- bakal jad menu pembayaran -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSPP" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                            <i class="ri-apps-2-line"></i> <span data-key="t-apps">SPP</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSPP">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="index.html" class="nav-link" data-key="t-calender">
                                        List SPP
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarCalendar">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="apps-calendar.html" class="nav-link" data-key="t-main-calender"> Main Calendar </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="apps-calendar-month-grid.html" class="nav-link" data-key="t-month-grid"> Month Grid </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="#sidebarPembayaran" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPembayaran" data-key="t-calender">
                                        Pembayaran
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarPembayaran">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="/pembayaran" class="nav-link" data-key="t-main-pembayaran"> Main Pembayaran </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="apps-Pembayaran-month-grid.html" class="nav-link" data-key="t-month-grid"> Month Grid </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="#sidebarMahasiswa" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMahasiswa" data-key="t-mahasiswa">
                                        Mahasiswa
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarMahasiswa">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="/list_pembayaran" class="nav-link" data-key="t-chat"> List Pembayaran </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/list_mahasiswa" class="nav-link" data-key="t-chat"> List Mahasiswa </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                            <i class="ri-compasses-2-line"></i> <span data-key="t-icons">Icons</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarIcons">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="icons-remix.html" class="nav-link"><span data-key="t-remix">Remix</span> <span class="badge badge-pill bg-info">v3.5</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="icons-boxicons.html" class="nav-link"><span data-key="t-boxicons">Boxicons</span> <span class="badge badge-pill bg-info">v2.1.4</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="icons-materialdesign.html" class="nav-link"><span data-key="t-material-design">Material Design</span> <span class="badge badge-pill bg-info">v7.2.96</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="icons-lineawesome.html" class="nav-link" data-key="t-line-awesome">Line Awesome</a>
                                </li>
                                <li class="nav-item">
                                    <a href="icons-feather.html" class="nav-link"><span data-key="t-feather">Feather</span> <span class="badge badge-pill bg-info">v4.29</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="icons-crypto.html" class="nav-link"> <span data-key="t-crypto-svg">Crypto SVG</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- Sidebar -->
        </div>

        <div class="sidebar-background"></div>
    </div>

</body>
</html>
