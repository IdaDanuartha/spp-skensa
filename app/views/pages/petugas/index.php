<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Petugas</h6>
            <a href="<?= route('petugas/create') ?>" class="btn btn-sm btn-primary btn-icon-split">
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
                            <th>Username</th>
                            <th>Nama Petugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['petugas'] as $key => $val) : ?>
                            <tr class="petugas_data">
                                <td><?= ++$key ?></td>
                                <td><?= $val['username'] ?></td>
                                <td><?= $val['nama'] ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailPetugasModal<?= $key ?>" class="btn btn-circle btn-info btn-sm mr-2">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <a href="<?= route('petugas/edit/' . $val['id']) ?>" class="btn btn-circle btn-warning btn-sm mr-2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button data-toggle="modal" data-target="#deletePetugasModal<?= $key ?>" class="btn btn-circle btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Detail petugas -->
                            <div class="modal fade" id="detailPetugasModal<?= $key ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-4">
                                            <h5 class="font-weight-bold mb-3">Detail petugas</h5>            
                                            <div class="mb-3">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" value="<?= $val['username'] ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama">Nama Petugas</label>
                                                <input type="text" class="form-control" value="<?= $val['nama'] ?>" readonly>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-secondary mr-3" data-dismiss="modal">Kembali</button>
                                            </div>                
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete petugas -->
                            <div class="modal fade" id="deletePetugasModal<?= $key ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center py-4">
                                            <h5 class="font-weight-bold mb-3">Hapus Petugas</h5>
                                            <form action="<?= route('petugas/destroy') ?>" method="post" class="px-5">
                                                <input type="hidden" class="data_petugas_id" name="id" value="<?= $val['id'] ?>">
                                                <p>Apakah anda yakin mau menghapus data petugas <span class="text-danger font-weight-bold">"<?= $val['nama'] ?>"</span>? Proses ini tidak dapat dikembalikan</p>
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