<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
        </div>
        <div class="card-body">
            <form action="<?= route('kelas/update') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $data['kelas']['id'] ?>">
                <div class="mb-3">
                    <label for="nama" id="nama">Nama Kelas</label>
                    <input type="text" class="form-control" placeholder="Input nama kelas" name="nama" value="<?= $data['kelas']['nama'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kompetensi_keahlian" id="kompetensi_keahlian">Kompetensi Keahlian</label>
                    <input type="text" class="form-control" name="kompetensi_keahlian" value="<?= $data['kelas']['kompetensi_keahlian'] ?>" placeholder="Input kompetensi keahlian kelas" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>