<div class="container-fluid">
    <?php Flasher::flash() ?>
    <form action="<?= route('laporan') ?>" method="post" class="d-flex align-items-end mb-4 border-bottom pb-3">
        <div class="col-xl-4 col-12">
            <div class="mb-3">
                <label for="">Tanggal mulai</label>
                <input type="date" name="start_date" class="form-control" value="<?= old("start_date") ?>">
            </div>        
        </div>
        <div class="col-xl-4 col-12">
            <div class="mb-3">
                <label for="">Tanggal selesai</label>
                <input type="date" name="end_date" class="form-control" value="<?= old("end_date") ?>">
            </div>
        </div>
        <div class="col-xl-4 col-12">
            <div class="mb-3">
                <button class="btn btn-primary" name="filter_laporan" type="submit">Tampilkan</button>
            </div>
        </div>
    </form>
    <?php if(count($data['transaksi']) > 0) : ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Pembayaran SPP</h6>
                <form action="<?= route('laporan/export') ?>" method="post">
                    <input type="hidden" name="start_date" value="<?= $_POST['start_date'] ?>">
                    <input type="hidden" name="end_date" value="<?= $_POST['end_date'] ?>">

                    <button type="submit" formtarget="_blank" class="btn btn-sm btn-info px-3">Export</button>
                </form>
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
    <?php endif; ?>
</div>