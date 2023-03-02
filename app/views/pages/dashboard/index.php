<div class="container-fluid">
    <?php Flasher::flash() ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard</h1>
        <?php if($_SESSION['user']['role'] !== 'siswa') : ?>
            <a href="<?= route('laporan') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-file-export fa-sm text-white-50"></i> Generate Laporan</a>
        <?php else : ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#detailTransaksiSiswaModal">Transaksi Saya</button>
        <?php endif; ?>
    </div>

    <?php if($_SESSION['user']['role'] !== 'siswa') : ?>
        <div class="row">
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_kelas'] ?> kelas</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bars fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_siswa'] ?> siswa</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Petugas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_petugas'] ?> petugas</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Transaksi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_transaksi'] ?> transaksi</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-5 col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Data Siswa Per Kelas</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach($data['kelas'] as $kelas) : ?>
                            <div class="d-flex justify-content-between border-bottom mb-3 pb-2">
                                <h6><?= $kelas['nama'] ?></h6>
                                <h6><?= $kelas['total_siswa'] ?> siswa</h6>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-12">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
                        <a href="<?= route('transaksi/histori') ?>" class="btn btn-sm btn-primary btn-icon-split">
                            <span class="icon text-white text-gray-100">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span class="text">
                                Lainnya
                            </span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Bulan Dibayar</th>
                                        <?php if($_SESSION['user']['role'] !== 'siswa') : ?>
                                            <th>Nama Siswa</th>
                                        <?php endif; ?>
                                        <th>Nama Petugas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data['transaksi'] as $key => $val) : ?>
                                        <tr class="siswa_data">
                                            <?php if($key === 5) break; ?>
                                            <td><?= ++$key ?></td>
                                            <td><?= date_format(date_create($val['tanggal_bayar']), "d M Y") ?></td>
                                            <td><?= date("F", mktime(0, 0, 0, $val['bulan_dibayar'], 10)) . ' ' . $val['tahun_dibayar'] ?></td>
                                            <?php if($_SESSION['user']['role'] !== 'siswa') : ?>
                                                <td><?= $val['nama_siswa'] ?></td>
                                            <?php endif; ?>
                                            <td><?= $val['nama_petugas'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="row">
            
            <div class="col-xl-4 col-md-6 col-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    SPP Belum Dibayar (Semester Ini)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Tersisa <?= $data['total_transaksi_belum_dibayar'] ?> bulan</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-md-6 col-12 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                SPP Bulan Ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['cek_transaksi_bulan_ini'] ? 'Sudah Bayar' : 'Belum Bayar' ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-12 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Transaksi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_transaksi_siswa'] ?> transaksi</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<!-- Detail Kelas --> 
<div class="modal fade" id="detailTransaksiSiswaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-4">
                <h5 class="font-weight-bold mb-4 text-center">Transaksi Pembayaran SPP Tahun Ini</h5>            
                <?php 
                    $bulan_dibayar = []; 
                    foreach($data['transaksi_siswa'] as $transaksi) {
                        array_push($bulan_dibayar, $transaksi['bulan_dibayar']);
                    }
                ?>
                <div class="row">
                    <?php foreach($data['bulan'] as $key => $val) : ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                            <?php if(in_array($key, $bulan_dibayar)) : ?>
                                <div class="card shadow" style="background-color: rgba(0,255,0,0.2)">
                                    <div class="card-body d-flex justify-content-between">
                                        <span class="text-success font-weight-bold"><?= $val ?></span>
                                        <div><i class="fas fa-check text-success fa-xs"></i></div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="card shadow">
                                    <div class="card-body d-flex justify-content-between" style="background-color: rgba(255,0,0,0.2)">
                                        <span class="text-danger font-weight-bold"><?= $val ?></span>                                            
                                        <div class="font-weight-bold text-danger">x</div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>         
            </div>
        </div>
    </div>
</div>