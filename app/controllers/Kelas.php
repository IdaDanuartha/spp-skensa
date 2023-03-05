<?php

class Kelas extends Controller {
    public function __construct()
    {
        if(Middleware::checkRole('siswa')) redirect('dashboard');
    }

    public function index()
    {                    
        $data = [
            "title" => "Data Kelas",
            "view" => "pages/kelas/index",
            "kelas" => $this->model("KelasModel")->getAllKelas()
        ];

        return $this->view("layouts/dashboard", $data);
    }

    public function create()
    {        
        $data = [
            "title" => "Tambah Kelas",
            "view" => "pages/kelas/create",
            "old" => $_POST
        ];

        if($_POST) $this->store($_POST);        
       
        return $this->view('layouts/dashboard', $data);
    }

    public function store($data)
    {        
        if($this->model('KelasModel')->findKelasByNama($data['nama'])) {            
            Flasher::setFlash("danger", 'Kelas <strong>"' . $data['nama'] . '"</strong> sudah ada');
        } else {
            if($this->model('KelasModel')->store($data) > 0) {                
                redirect("kelas", ["success", "Data kelas berhasil ditambahkan"]);
            } else {
                Flasher::setFlash("danger", "Data kelas gagal ditambahkan");
            }
        }      
    }

    public function detail($id)
    {            
       
        echo json_encode($this->model('KelasModel')->findKelas($id));
    }

    public function edit($id)
    {        
        $data = [
            "title" => "Edit Kelas",
            "view" => "pages/kelas/edit",
            "kelas" => $this->model('KelasModel')->findKelas($id)
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function update()
    {
        if(!$_POST) return redirect('kelas');

        if($this->model('KelasModel')->findKelasByNamaExceptThisId($_POST['nama'], $_POST['id'])) {
            Flasher::setFlash("danger", 'Kelas <strong>"' . $_POST['nama'] . '"</strong> sudah ada');
            redirect("kelas/edit/$_POST[id]");
        } else {
            if($this->model('KelasModel')->update($_POST) > 0) {
                Flasher::setFlash("success", "Data kelas berhasil diubah");
                redirect("kelas");
            } else {
                Flasher::setFlash("danger", "Data kelas gagal diubah");
                redirect("kelas/edit/$_POST[id]");
            }
        }
    }

    public function destroy()
    {    
        if(!$_POST) return redirect('kelas');

        if($this->model('KelasModel')->destroy($_POST['id']) > 0) {
            Flasher::setFlash("success", "Data kelas berhasil dihapus");
            redirect("kelas");
        } else {
            Flasher::setFlash("danger", "Data kelas gagal dihapus");
            redirect("kelas");
        }
    }
}