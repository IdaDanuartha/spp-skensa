<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
            <a href="<?= route('pembayaran/create') ?>" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white text-gray-100">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">
                    Tambah
                </span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Nominal Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['pembayaran'] as $key => $val) : ?>
                            <tr class="pembayaran_data">                                
                                <td><?= ++$key ?></td>
                                <td><?= $val['tahun_ajaran'] ?></td>
                                <td><?= rupiah($val['nominal']) ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailPembayaranModal<?= $key ?>" class="btn btn-circle btn-info btn-sm mr-2">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <a href="<?= route('pembayaran/edit/' . $val['id']) ?>" class="btn btn-circle btn-warning btn-sm mr-2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button data-toggle="modal" data-target="#deletePembayaranModal<?= $key ?>" class="btn btn-circle btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Detail pembayaran -->
                            <div class="modal fade" id="detailPembayaranModal<?= $key ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-4">
                                            <h5 class="font-weight-bold mb-3">Detail Pembayaran</h5>            
                                            <div class="mb-3">
                                                <label for="">Tahun Ajaran</label>
                                                <input type="text" class="form-control" value="<?= $val['tahun_ajaran'] ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Nominal Pembayaran</label>
                                                <input type="text" class="form-control" value="<?= $val['nominal'] ?>" readonly>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-secondary mr-3" data-dismiss="modal">Kembali</button>
                                            </div>                
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete pembayaran -->
                            <div class="modal fade" id="deletePembayaranModal<?= $key ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center py-4">
                                            <h5 class="font-weight-bold mb-3">Hapus Pembayaran</h5>
                                            <form action="<?= route('pembayaran/destroy') ?>" method="post" class="px-5">
                                                <input type="hidden" class="data_pembayaran_id" name="id" value="<?= $val['id'] ?>">
                                                <p>Apakah anda yakin mau menghapus data pembayaran tahun ajaran <span class="text-danger font-weight-bold">"<?= $val['tahun_ajaran'] ?>"</span>? Proses ini tidak dapat dikembalikan</p>
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