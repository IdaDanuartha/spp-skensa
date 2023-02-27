<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN / NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['siswa'] as $key => $val) : ?>
                            <tr class="siswa_data">
                                <td><?= ++$key ?></td>
                                <td><?= $val['nisn'] . ' / ' . $val['nis'] ?></td>
                                <td><?= $val['nama'] ?></td>
                                <td><?= $val['kelas'] ?></td>
                                <td>
                                    <a href="<?= route('transaksi/create') ?>" class="btn btn-primary btn-sm">
                                        Bayar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>