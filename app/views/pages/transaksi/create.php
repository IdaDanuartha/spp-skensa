<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <form action="<?= route('siswa/store') ?>" method="POST">
                <div class="row g-3">
                    <div class="col-lg-8 row g-3">
                        <?php foreach($data['bulan'] as $key => $val) : ?>
                            <div class="col-xl-3 col-lg-4 col-12 mb-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <span><?= $val ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>                                          
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>