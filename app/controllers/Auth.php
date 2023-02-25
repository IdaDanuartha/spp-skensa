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
        ];
       
        return $this->view('layouts/auth', $data);
    }

    public function process()
    {
        if(!$_POST) return redirect('auth');

        if($this->model('PenggunaModel')->login($_POST)) {
            Flasher::setFlash("success", "Halo selamat datang di Website SPP Skensa");
            redirect("dashboard");
        } else {
            Flasher::setFlash("danger", "Username atau password anda salah");
            redirect("auth");
        }
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user']);

        redirect('auth');
    }
}