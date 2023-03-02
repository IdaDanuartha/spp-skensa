<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 font-weight-bold mb-4">Selamat Datang Di Website SPP Skensa</h1>
            </div>
            <?php Flasher::flash() ?>
            <form class="user" action="<?= route("auth/login") ?>" method="POST">
                <div class="form-group">
                    <input type="text" required class="form-control form-control-user"
                        id="username" aria-describedby="username"
                        placeholder="Enter username..." name="username" autofocus value="<?= old('username') ?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user"
                        id="password" placeholder="Enter password" name="password">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>