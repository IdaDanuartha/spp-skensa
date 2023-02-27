<?php

class Transaksi extends Controller {
    public function __construct()
    {
        if(Middleware::checkRole('siswa')) redirect('dashboard');
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

    public function create()
    {        
        $bulan = [
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

        $data = [
            "title" => "Tambah Transaksi",
            "view" => "pages/transaksi/create",
            "bulan" => $bulan,
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function store()
    {
        if(!$_POST) return redirect('transaksi');
        
        if($this->model('TransaksiModel')->findTransaksiByMonth($_POST['bulan_dibayar'], $_POST['siswa_id'])) {
            Flasher::setFlash("danger", 'Pembayaran SPP bulan ini sudah lunas');
            redirect("transaksi/create");
        } else {
            if($this->model('TransaksiModel')->store($_POST) > 0) {
                Flasher::setFlash("success", "Data transaksi berhasil ditambahkan");
                redirect("transaksi");
            } else {
                Flasher::setFlash("danger", "Data transaksi gagal ditambahkan");
                redirect("transaksi/create");
            }
        }      
    }    

    public function destroy()
    {
        if(!$_POST) return redirect('transaksi');

        if($this->model('TransaksiModel')->destroy($_POST['id']) > 0) {
            Flasher::setFlash("success", "Data transaksi berhasil dihapus");
            redirect("transaksi");
        } else {
            Flasher::setFlash("danger", "Data transaksi gagal dihapus");
            redirect("transaksi");
        }
    }
}