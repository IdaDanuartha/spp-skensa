<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pembayaran SPP Siswa Tahun Ini</h6>
            <a href="<?= route('transaksi/detail/' . $data['siswa']['id']) ?>" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white text-gray-100">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">
                    Detail
                </span>
            </a>
        </div>
        <div class="card-body">
            <form action="<?= route('transaksi/store') ?>" method="POST">
                <input type="hidden" name="siswa_id" value="<?= $data['siswa']['id'] ?>">
                <input type="hidden" name="pembayaran_id" value="<?= $data['siswa']['pembayaran_id'] ?>">
                <div class="row g-3 mb-3">
                    <div class="col-lg-8 col-12 row g-3">
                        <?php 
                            $bulan_dibayar = []; 
                            foreach($data['transaksi'] as $transaksi) {
                                array_push($bulan_dibayar, $transaksi['bulan_dibayar']);
                            }
                        ?>
                        <?php foreach($data['bulan'] as $key => $val) : ?>
                            <div class="col-xl-3 col-lg-4 col-12 mb-3">
                                <?php if(in_array($key, $bulan_dibayar)) : ?>
                                    <div class="card shadow" style="background-color: rgba(0,255,0,0.2)">
                                        <div class="card-body d-flex justify-content-between">
                                            <span class="text-success font-weight-bold"><?= $val ?></span>
                                            <div><i class="fas fa-check text-success fa-xs"></i></div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="card shadow">
                                        <div class="card-body d-flex justify-content-between" style="background-color: rgba(255,0,0,0.2)">
                                            <span class="text-danger font-weight-bold"><?= $val ?></span>                                            
                                            <div class="font-weight-bold text-danger">x</div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card shadow p-3">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="<?= asset('img/undraw_profile.svg') ?>" width="100" alt="">
                            </div>
                            <div class="text-center">
                                <h6><?= $data['siswa']['nama'] ?></h6>
                                <h6><?= $data['siswa']['nisn'] ?> / <?= $data['siswa']['nis'] ?></h6>
                                <h6><?= $data['siswa']['kelas'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="">
                    <div class="card shadow p-3 col-lg-4 col-12">
                        <h6 class="font-weight-bold mb-3">Form Pembayaran</h6>
                        <div class="mb-3">
                            <label for="">Nominal Pembayaran</label>
                            <input type="text" readonly class="form-control" value="Rp. 100.000/bulan">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Bayar</label>
                            <input type="date" class="form-control" name="tanggal_bayar" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Bulan Dibayar</label>
                            <select name="bulan_dibayar" class="form-control">
                                <?php foreach($data['bulan'] as $key => $val) : ?>
                                    <option value="<?= $key ?>"><?= $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        </div>
                    </div>
                </div>                                         
            </form>
        </div>
    </div>
</div>