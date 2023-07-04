<nav class="navbar navbar-expand navbar-dark bg-danger static-top">

    <a class="navbar-brand mr-1" href="<?php echo site_url('admin/admin') ?>">Sistem Penilaian Guru</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
        </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li>
        </li>

        <li>
        </li>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Selamat Datang <?php echo $this->session->userdata('nama'); ?>
            </a>
        </li>
    </ul>

</nav>