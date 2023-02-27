<?php

class Dashboard extends Controller {
    public function index()
    {         
        Middleware::onlyLoggedIn();   
        $data = [
            "title" => "Dashboard",
            "view" => "pages/dashboard/index",
            "total_kelas" => count($this->model('KelasModel')->getAllKelas()),
            "total_siswa" => count($this->model('SiswaModel')->getAllSiswa()),
            "total_petugas" => count($this->model('PetugasModel')->getAllPetugas()),
            "total_transaksi" => count($this->model('TransaksiModel')->getAllTransaksi()),
            "kelas" => $this->model('KelasModel')->getAllKelas(),
            "transaksi" => $this->model('TransaksiModel')->getAllTransaksi(),
        ];

        return $this->view("layouts/dashboard", $data);
    }
}