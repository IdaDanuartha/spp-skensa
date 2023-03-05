<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <form action="<?= route('siswa/create') ?>" method="POST">
                <div class="row g-4">
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="nisn" id="nisn">NISN</label>
                        <input type="text" class="form-control" placeholder="Input nisn siswa" name="nisn" required value="<?= old('nisn') ?>">
                    </div>
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="nis" id="nis">NIS</label>
                        <input type="text" class="form-control" name="nis" placeholder="Input nis siswa" required value="<?= old('nis') ?>">
                    </div>
                </div>
                <div class="row g-4">
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="nama" id="nama">Nama Siswa</label>
                        <input type="text" class="form-control" name="nama" placeholder="Input nama siswa" required value="<?= old('nama') ?>">
                    </div>
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="alamat" id="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Input alamat siswa" required value="<?= old('alamat') ?>">
                    </div>
                </div>
                <div class="row g-4">
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="telepon" id="telepon">No. Telepon</label>
                        <input type="number" class="form-control" name="telepon" placeholder="Input nomor telepon siswa" required value="<?= old('telepon') ?>">
                    </div>
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="kelas_id" id="kelas_id">Pilih Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-control">
                            <?php foreach($data['kelas'] as $kelas) : ?>
                                <?php if($kelas['id'] == old('kelas_id')) : ?>
                                    <option value="<?= $kelas['id'] ?>" selected><?= $kelas['nama'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $kelas['id'] ?>"><?= $kelas['nama'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="pembayaran_id" id="pembayaran_id">Pilih Tahun Ajaran</label>
                        <select name="pembayaran_id" id="pembayaran_id" class="form-control">
                            <?php foreach($data['pembayaran'] as $pembayaran) : ?>
                                <?php if($pembayaran['id'] == old('pembayaran_id')) : ?>
                                    <option value="<?= $pembayaran['id'] ?>" selected><?= $pembayaran['tahun_ajaran'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $pembayaran['id'] ?>"><?= $pembayaran['tahun_ajaran'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="password" id="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Input password siswa" required>
                    </div>
                </div>                                            
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>