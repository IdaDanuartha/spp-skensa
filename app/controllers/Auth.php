<?php

class Auth extends Controller {
    public function __construct()
    {
        // Middleware::onlyNotLoggedIn();
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        $data = [
            "view" => "pages/auth/login"
        ];

        return $this->view('layouts/auth', $data);
    }

    public function process()
    {
        
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user']);

        redirect('auth');
    }
}