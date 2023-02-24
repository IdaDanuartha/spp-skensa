<?php

class Dashboard extends Controller {
    public function index()
    {
        $data['pengguna'] = $this->model("PenggunaModel")->findPenggunaByUsername("admin");
        dd($data['pengguna']);
    }
}