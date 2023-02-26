<?php

class Dashboard extends Controller {
    public function index()
    {         
        Middleware::onlyLoggedIn();   
        $data = [
            "title" => "Dashboard",
            "view" => "pages/dashboard/index",
            "pengguna" => $this->model("PenggunaModel")->findPenggunaByUsername("admin")
        ];

        return $this->view("layouts/dashboard", $data);
    }
}