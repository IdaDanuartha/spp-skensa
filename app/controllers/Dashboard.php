<?php

class Dashboard extends Controller {
    public function __construct()
    {        
        // Middleware::onlyLoggedIn();
    }

    public function index()
    {        
        $data = [
            "view" => "pages/dashboard/index",
            "pengguna" => $this->model("PenggunaModel")->findPenggunaByUsername("admin")
        ];

        return $this->view("layouts/dashboard", $data);
    }
}