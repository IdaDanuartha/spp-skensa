<?php

class Siswa extends Controller {
    public function __construct()
    {
        if(!Middleware::checkRole('admin')) redirect('dashboard');
    }

    public function index()
    {         
        Middleware::onlyLoggedIn();   
        $data = [
            "title" => "Data Siswa",
            "view" => "pages/siswa/index",
            "siswa" => $this->model("SiswaModel")->getAllSiswa()
        ];

        return $this->view("layouts/dashboard", $data);
    }

    public function create()
    {
        Middleware::onlyLoggedIn();
        $data = [
            "title" => "Tambah Siswa",
            "view" => "pages/siswa/create",
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function store()
    {
        if(!$_POST) return redirect('siswa');
        
        if($this->model('SiswaModel')->findSiswaByColumn($_POST['nisn'])) {
            Flasher::setFlash("danger", 'Siswa dengan NISN <strong>"' . $_POST['nisn'] . '"</strong> sudah ada');
            redirect("siswa/create");
        } else {
            if($this->model('SiswaModel')->store($_POST) > 0) {
                Flasher::setFlash("success", "Data siswa berhasil ditambahkan");
                redirect("siswa");
            } else {
                Flasher::setFlash("danger", "Data siswa gagal ditambahkan");
                redirect("siswa/create");
            }
        }      
    }

    public function detail($id)
    {
        Middleware::onlyLoggedIn();    
       
        echo json_encode($this->model('SiswaModel')->findSiswa($id));
    }

    public function edit($id)
    {
        Middleware::onlyLoggedIn();
        $data = [
            "title" => "Edit Siswa",
            "view" => "pages/siswa/edit",
            "siswa" => $this->model('SiswaModel')->findSiswa($id)
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function update()
    {
        if(!$_POST) return redirect('siswa');

        if($this->model('SiswaModel')->findSiswaByColumnExceptThisId($_POST['nisn'], $_POST['id'])) {
            Flasher::setFlash("danger", 'Siswa dengan NISN <strong>"' . $_POST['nisn'] . '"</strong> sudah ada');
            redirect("siswa/edit/$_POST[id]");
        } else {
            if($this->model('SiswaModel')->update($_POST) > 0) {
                Flasher::setFlash("success", "Data siswa berhasil diubah");
                redirect("siswa");
            } else {
                Flasher::setFlash("danger", "Data siswa gagal diubah");
                redirect("siswa/edit/$_POST[id]");
            }
        }
    }

    public function destroy()
    {    
        if(!$_POST) return redirect('siswa');

        if($this->model('SiswaModel')->destroy($_POST['id']) > 0) {
            Flasher::setFlash("success", "Data siswa berhasil dihapus");
            redirect("siswa");
        } else {
            Flasher::setFlash("danger", "Data siswa gagal dihapus");
            redirect("siswa");
        }
    }
}