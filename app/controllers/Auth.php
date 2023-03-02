<?php

class Auth extends Controller {
    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        Middleware::onlyNotLoggedIn();
        $data = [
            "view" => "pages/auth/login",
            "old" => $_POST
        ];

        if($_POST) $this->process($_POST);
       
        return $this->view('layouts/auth', $data);
    }

    public function process()
    {
        if($this->model('PenggunaModel')->login($_POST)) {            
            $userLoggedIn = $_SESSION['user']['role'] === 'siswa' ? $_SESSION['user']['nama'] : $_SESSION['user']['username'];
            Flasher::setFlash("success", "Halo <strong>" . $userLoggedIn . "</strong> selamat datang di Website SPP Skensa");
            redirect("dashboard");
        } else {
            Flasher::setFlash("danger", "Username atau password anda salah");
        }
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user']);

        redirect('auth');
    }
}