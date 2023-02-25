<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
            <a href="<?= route('kelas/create') ?>" class="btn btn-sm btn-primary btn-icon-split">
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
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Total Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['kelas'] as $key => $val) : ?>
                            <tr class="kelas_data">
                                <input type="hidden" class="kelas_id" value="<?= $val['id'] ?>">
                                <td><?= ++$key ?></td>
                                <td><?= $val['nama'] ?></td>
                                <td><?= $val['kompetensi_keahlian'] ?></td>
                                <td><?= $val['total_siswa'] ?> siswa</td>                                
                                <td>
                                    <button data-toggle="modal" data-target="#detailKelasModal" class="btn btn-circle btn-info btn-sm mr-2">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <a href="<?= route('kelas/edit/' . $val['id']) ?>" class="btn btn-circle btn-warning btn-sm mr-2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button data-toggle="modal" data-target="#deleteKelasModal" class="btn btn-circle btn-danger btn-sm detail-kelas-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Detail Kelas -->
<div class="modal fade" id="detailKelasModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <h5 class="font-weight-bold mb-3">Detail Kelas</h5>
                <form class="px-5">
                    <div class="mb-3">
                        <label for="">Nama Kelas</label>
                        <input type="text" class="input_kelas form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Nama Kelas</label>
                        <input type="text" class="input_kelas form-control">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-secondary mr-3" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Kelas -->
<div class="modal fade" id="deleteKelasModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <h5 class="font-weight-bold mb-3">Hapus Kelas</h5>
                <form action="<?= route('kelas/destroy') ?>" method="post" class="px-5">
                    <input type="hidden" class="data_kelas_id" name="id" value="9">
                    <p>Apakah anda yakin mau menghapus data kelas <span class="text-danger font-weight-bold nama_kelas">""</span>? Proses ini tidak dapat dikembalikan</p>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary mr-3" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>