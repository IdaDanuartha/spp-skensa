<?php

class Dashboard extends Controller {
    private $bulan = [
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember",
    ];

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
            "total_transaksi_belum_dibayar" => 6 - count($this->model('TransaksiModel')->getTransaksiThisSemester($_SESSION['user']['id'])),
            "cek_transaksi_bulan_ini" => $this->model('TransaksiModel')->findTransaksiByMonth(date('m'), $_SESSION['user']['id']),
            "total_transaksi_siswa" => count($this->model('TransaksiModel')->getAllTransaksiSiswa($_SESSION['user']['id'])),
            "transaksi_siswa" => $this->model('TransaksiModel')->getTransaksiSiswaThisYear($_SESSION['user']['id']),
            "bulan" => $this->bulan,
        ];  
        
        return $this->view("layouts/dashboard", $data);
    }
}