<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi <?= $data['siswa']['nama'] ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Transaksi</th>
                            <th>Bulan Dibayar</th>                            
                            <th>Nama Petugas</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['transaksi'] as $key => $val) : ?>
                            <tr class="siswa_data">
                                <td><?= ++$key ?></td>
                                <td><?= date_format(date_create($val['tanggal_bayar']), "d M Y") ?></td>
                                <td><?= date("F", mktime(0, 0, 0, $val['bulan_dibayar'], 10)) . ' ' . $val['tahun_dibayar'] ?></td>

                                <td><?= $val['nama_petugas'] ?></td>
                                <td><?= rupiah($val['nominal']) ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#deleteTransaksiModal<?= $key ?>" class="btn btn-circle btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete petugas -->
                            <div class="modal fade" id="deleteTransaksiModal<?= $key ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center py-4">
                                            <h5 class="font-weight-bold mb-3">Hapus Transaksi</h5>
                                            <form action="<?= route('transaksi/destroy') ?>" method="post" class="px-5">
                                                <input type="hidden" name="siswa_id" value="<?= $val['siswa_id'] ?>">
                                                <input type="hidden" name="id" value="<?= $val['id'] ?>">
                                                <p>Apakah anda yakin mau menghapus data transaksi bulan <span class="text-danger font-weight-bold">"<?= date("F", mktime(0, 0, 0, $val['bulan_dibayar'], 10)) ?>"</span>? Proses ini tidak dapat dikembalikan</p>
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-secondary mr-3" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>