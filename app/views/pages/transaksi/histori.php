<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Histori Transaksi Pembayaran</h6>
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
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['transaksi'] as $key => $val) : ?>
                            <tr class="siswa_data">
                                <td><?= ++$key ?></td>
                                <td><?= date_format(date_create($val['tanggal_bayar']), "d M Y") ?></td>
                                <td><?= date("F", mktime(0, 0, 0, $val['bulan_dibayar'], 10)) . ' ' . $val['tahun_dibayar'] ?></td>
                                <?php if($_SESSION['user']['role'] !== 'siswa') : ?>
                                    <td><?= $val['nama_siswa'] ?></td>
                                <?php endif; ?>
                                <td><?= $val['nama_petugas'] ?></td>
                                <td><?= rupiah($val['nominal']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>