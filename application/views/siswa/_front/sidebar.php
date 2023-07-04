<!-- Sidebar -->
<ul class="sidebar navbar-nav bg-secondary">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('siswa/siswa') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span class="text-white">Beranda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>siswa/pertanyaan/">
            <i class="fas fa-fw fa-user"></i>
            <span class="text-white">Pertanyaan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>login/logout">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span class="text-white">Keluar</span></a>
    </li>
</ul>