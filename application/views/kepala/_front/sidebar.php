<!-- Sidebar -->
<ul class="sidebar navbar-nav bg-secondary">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('kepala/kepala') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span class="text-white">Beranda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>kepala/laporan/">
            <i class="fas fa-fw fa-user"></i>
            <span class="text-white">Laporan Evaluasi Guru</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>login/logout">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span class="text-white">Keluar</span></a>
    </li>
</ul>