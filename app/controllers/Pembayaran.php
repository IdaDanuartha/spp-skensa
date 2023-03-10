<?php

class Pembayaran extends Controller {
    public function __construct()
    {
        if(!Middleware::checkRole('admin')) redirect('dashboard');
    }

    public function index()
    {                
        $data = [
            "title" => "Data Pembayaran",
            "view" => "pages/pembayaran/index",
            "pembayaran" => $this->model("PembayaranModel")->getAllPembayaran()
        ];

        return $this->view("layouts/dashboard", $data);
    }

    public function create()
    {    
        $data = [
            "title" => "Tambah Pembayaran",
            "view" => "pages/pembayaran/create",
            "old" => $_POST
        ];

        if($_POST) $this->store($_POST);

        return $this->view('layouts/dashboard', $data);
    }

    public function store()
    {        
        if($this->model('PembayaranModel')->findPembayaranByTahunAjaran($_POST['tahun_ajaran'])) {
            Flasher::setFlash("danger", 'Pembayaran <strong>"' . $_POST['tahun_ajaran'] . '"</strong> sudah ada');
        } else {
            if($this->model('PembayaranModel')->store($_POST) > 0) {                
                redirect("pembayaran", ["success", "Data pembayaran berhasil ditambahkan"]);
            } else {
                Flasher::setFlash("danger", "Data pembayaran gagal ditambahkan");
            }
        }      
    }

    public function detail($id)
    {        
       
        echo json_encode($this->model('PembayaranModel')->findPembayaran($id));
    }

    public function edit($id)
    {    
        $data = [
            "title" => "Edit Pembayaran",
            "view" => "pages/pembayaran/edit",
            "pembayaran" => $this->model('PembayaranModel')->findPembayaran($id)
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function update()
    {
        if(!$_POST) return redirect('pembayaran');

        if($this->model('PembayaranModel')->findPembayaranByTahunAjaranExceptThisId($_POST['tahun_ajaran'], $_POST['id'])) {
            Flasher::setFlash("danger", 'Pembayaran <strong>"' . $_POST['tahun_ajaran'] . '"</strong> sudah ada');
            redirect("pembayaran/edit/$_POST[id]");
        } else {
            if($this->model('PembayaranModel')->update($_POST) > 0) {
                Flasher::setFlash("success", "Data pembayaran berhasil diubah");
                redirect("pembayaran");
            } else {
                Flasher::setFlash("danger", "Data pembayaran gagal diubah");
                redirect("pembayaran/edit/$_POST[id]");
            }
        }     
    }

    public function destroy()
    {
        if(!$_POST) return redirect('pembayaran');

        if($this->model('PembayaranModel')->destroy($_POST['id']) > 0) {
            Flasher::setFlash("success", "Data pembayaran berhasil dihapus");
            redirect("pembayaran");
        } else {
            Flasher::setFlash("danger", "Data pembayaran gagal dihapus");
            redirect("pembayaran");
        }
    }
}