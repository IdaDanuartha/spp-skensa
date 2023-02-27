<?php

class Laporan extends Controller {
    public function __construct()
    {
        if(!Middleware::checkRole('admin')) redirect('dashboard');
    }

    public function index()
    {    
        $transaksi = [];                
        if(isset($_POST['filter_laporan'])) {
            $rows = $this->model("TransaksiModel")->getTransaksiByDate($_POST['start_date'], $_POST['end_date']);

            if(count($rows) > 0) {
                $transaksi = $rows;
            } else {
                Flasher::setFlash("danger", "Data transaksi untuk tanggal tersebut tidak ditemukan");
            }
        }

        $data = [
            "title" => "Laporan Transaksi",
            "view" => "pages/laporan/index",
            "transaksi" => $transaksi
        ];

        return $this->view("layouts/dashboard", $data);
    }  

    public function export()
    {    
        $data['transaksi'] = $this->model("TransaksiModel")->getTransaksiByDate($_POST['start_date'], $_POST['end_date']);

        return $this->view("pages/laporan/export", $data);
    }    
}