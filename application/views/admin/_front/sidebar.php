<!-- Sidebar -->
<ul class="sidebar navbar-nav bg-secondary">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active' : '' ?>">
        <a class="nav-link" href="<?php echo site_url('admin/admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span class="text-white">Beranda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/guru/">
            <i class="fas fa-fw fa-users"></i>
            <span class="text-white">Master Guru</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/kriteria/">
            <i class="fas fa-fw fa-sitemap"></i>
            <span class="text-white">Master Kriteria</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/alternatif/nilai_awal/">
            <i class="fas fa-fw fa-star-half-alt"></i>
            <span class="text-white">Master Nilai Awal</span></a>
    </li>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'products' ? 'active' : '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-square-root-alt"></i>
            <span class="text-white">Perhitungan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <!-- <a class="dropdown-item text-dark" href="<?php echo site_url('admin/kriteria/analisa ') ?>" style="font-size:10pt;">Perhitungan Kriteria</a> -->
            <a class="dropdown-item text-dark" href="<?php echo site_url('admin/alternatif/analisa') ?>" style="font-size:10pt; ">Perhitungan + Keterangan</a>
            <!-- <a class="dropdown-item text-dark" href="<?php echo site_url('admin/alternatif/perbandingan_alternatif') ?>" style="font-size:10pt;">Hasil Perhitung Alternatif</a>
            <a class="dropdown-item text-dark" href="<?php echo site_url('admin/kriteria/hasil_perhitungan') ?>" style="font-size:10pt;">Hasil</a> -->

        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/user/">
            <i class="fas fa-fw fa-user"></i>
            <span class="text-white">Master Pengguna</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>login/logout">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span class="text-white">Keluar</span></a>
    </li>
</ul>