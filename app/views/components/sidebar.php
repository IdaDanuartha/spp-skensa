<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SPP Skensa</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?= activeURL('/dashboard') ?>">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>



<?php if($_SESSION['user']['role'] !== 'siswa') : ?>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Administrator
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= activeURL('/kelas') ?>" href="<?= route('kelas') ?>">Data Kelas</a>
                <?php if($_SESSION['user']['role'] === 'admin') : ?>
                    <a class="collapse-item <?= activeURL('/siswa') ?>" href="<?= route('siswa') ?>">Data Siswa</a>
                    <a class="collapse-item <?= activeURL('/petugas') ?>" href="<?= route('petugas') ?>">Data Petugas</a>
                    <a class="collapse-item <?= activeURL('/pembayaran') ?>" href="<?= route('pembayaran') ?>">Data Pembayaran</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
<?php endif; ?>

<?php if($_SESSION['user']['role'] !== 'siswa') : ?>
    <!-- Nav Item - Entri Transaksi -->
    <li class="nav-item <?= activeURL('/transaksi') ?>">
        <a class="nav-link" href="<?= route('transaksi') ?>">
            <i class="fas fa-fw fa-money-bill-alt"></i>
            <span>Entri Transaksi</span></a>
    </li>
<?php endif; ?>

<!-- Nav Item - Histori Pembayaran -->
<li class="nav-item <?= activeURL('/transaksi/histori') ?>">
    <a class="nav-link" href="<?= route('transaksi/histori') ?>">
        <i class="fas fa-fw fa-file-archive"></i>
        <span>Histori Pembayaran</span></a>
</li>

<?php if($_SESSION['user']['role'] === 'admin') : ?>
    <!-- Nav Item - Laporan -->
    <li class="nav-item <?= activeURL('/laporan') ?>">
        <a class="nav-link" href="<?= route('laporan') ?>">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span></a>
    </li>
<?php endif; ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->