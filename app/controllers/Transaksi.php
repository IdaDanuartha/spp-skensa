<?php

class Transaksi extends Controller {
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

    public function __construct()
    {
        Middleware::onlyLoggedIn();
    }

    public function index()
    {                    
        $data = [
            "title" => "Transaksi Pembayaran",
            "view" => "pages/transaksi/index",
            "siswa" => $this->model("SiswaModel")->getAllSiswa()
        ];

        return $this->view("layouts/dashboard", $data);
    }

    public function histori()
    {        
        if(Middleware::checkRole('siswa')) {
            $transaksi = $this->model("TransaksiModel")->getAllTransaksiSiswa($_SESSION['user']['id']);
        } else {
            $transaksi = $this->model("TransaksiModel")->getAllTransaksi();
        }

        $data = [
            "title" => "Detail Transaksi",
            "view" => "pages/transaksi/histori",
            "transaksi" => $transaksi
        ];

        return $this->view("layouts/dashboard", $data);
    }

    public function detail($siswa_id)
    {                    
        $data = [
            "title" => "Detail Transaksi",
            "view" => "pages/transaksi/detail",
            "siswa" => $this->model("SiswaModel")->findSiswa($siswa_id),
            "transaksi" => $this->model("TransaksiModel")->getAllTransaksiSiswa($siswa_id)
        ];

        return $this->view("layouts/dashboard", $data);
    }

    public function create($siswa_id)
    {       
        $data = [
            "title" => "Tambah Transaksi",
            "view" => "pages/transaksi/create",
            "bulan" => $this->bulan,
            "transaksi" => $this->model('TransaksiModel')->getTransaksiSiswaThisYear($siswa_id),
            "siswa" => $this->model('SiswaModel')->findSiswa($siswa_id),
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function store()
    {
        if(!$_POST) return redirect('transaksi');
        
        if($this->model('TransaksiModel')->findTransaksiByMonth($_POST['bulan_dibayar'], $_POST['siswa_id'])) {
            $nama_bulan = strtolower($this->bulan[$_POST['bulan_dibayar']]);
            Flasher::setFlash("danger", "Pembayaran SPP bulan $nama_bulan sudah lunas");
            redirect("transaksi/create/$_POST[siswa_id]");
        } else {
            if($this->model('TransaksiModel')->store($_POST)) {
                Flasher::setFlash("success", "Data transaksi berhasil ditambahkan");
                redirect("transaksi/create/$_POST[siswa_id]");
            } else {
                Flasher::setFlash("danger", "Data transaksi gagal ditambahkan");
                redirect("transaksi/create/$_POST[siswa_id]");
            }
        }      
    }    

    public function destroy()
    {
        if(!$_POST) return redirect('transaksi');

        if($this->model('TransaksiModel')->destroy($_POST['id'])) {
            Flasher::setFlash("success", "Data transaksi berhasil dihapus");
            redirect("transaksi/detail/$_POST[siswa_id]");
        } else {
            Flasher::setFlash("danger", "Data transaksi gagal dihapus");
            redirect("transaksi/detail/$_POST[siswa_id]");
        }
    }
}