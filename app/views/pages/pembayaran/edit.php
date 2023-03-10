<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
        </div>
        <div class="card-body">
            <form action="<?= route('pembayaran/update') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $data['pembayaran']['id'] ?>">
                <div class="mb-3">
                    <label for="tahun_ajaran" id="tahun_ajaran">Tahun Ajaran</label>
                    <input type="text" class="form-control" placeholder="Input tahun ajaran" name="tahun_ajaran" value="<?= $data['pembayaran']['tahun_ajaran'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nominal" id="nominal">Nominal Pembayaran</label>
                    <input type="text" class="form-control" name="nominal" value="<?= rupiah($data['pembayaran']['nominal']) ?>" placeholder="Input nominal pembayaran" readonly >
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>