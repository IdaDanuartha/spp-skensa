<div class="container-fluid">
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Petugas</h6>
        </div>
        <div class="card-body">
            <form action="<?= route('petugas/store') ?>" method="POST">
                <div class="row g-4">
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="username" id="username">Username</label>
                        <input type="text" class="form-control" placeholder="Input username petugas" name="username" required>
                    </div>
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="nama" id="nama">Nama Petugas</label>
                        <input type="text" class="form-control" name="nama" placeholder="Input nama petugas" required>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="mb-3 col-12">
                        <label for="password" id="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Input password petugas" required>
                    </div>
                </div>                                            
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>