<?php

class Petugas extends Controller {
    public function __construct()
    {
        if(!Middleware::checkRole('admin')) redirect('dashboard');
    }

    public function index()
    {                    
        $data = [
            "title" => "Data Petugas",
            "view" => "pages/petugas/index",
            "petugas" => $this->model("PetugasModel")->getAllPetugas()
        ];

        return $this->view("layouts/dashboard", $data);
    }

    public function create()
    {        
        $data = [
            "title" => "Tambah Petugas",
            "view" => "pages/petugas/create",
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function store()
    {
        if(!$_POST) return redirect('petugas');
        
        if($this->model('PetugasModel')->findAccountPetugasByUsername($_POST['username'])) {
            Flasher::setFlash("danger", 'Petugas dengan username <strong>"' . $_POST['username'] . '"</strong> sudah ada');
            redirect("petugas/create");
        } else if($this->model('PetugasModel')->findPetugasByNama($_POST['nama'])) {
            Flasher::setFlash("danger", 'Petugas dengan nama <strong>"' . $_POST['nama'] . '"</strong> sudah ada');
            redirect("petugas/create");
        } else {
            if($this->model('PetugasModel')->store($_POST) > 0) {
                Flasher::setFlash("success", "Data petugas berhasil ditambahkan");
                redirect("petugas");
            } else {
                Flasher::setFlash("danger", "Data petugas gagal ditambahkan");
                redirect("petugas/create");
            }
        }      
    }

    public function detail($id)
    {            
       
        echo json_encode($this->model('PetugasModel')->findPetugas($id));
    }

    public function edit($id)
    {        
        $data = [
            "title" => "Edit Petugas",
            "view" => "pages/petugas/edit",
            "petugas" => $this->model('PetugasModel')->findPetugas($id),
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function update()
    {
        if(!$_POST) return redirect('petugas');

        if($this->model('PetugasModel')->findAccountPetugasByUsernameExceptThisId($_POST['username'], $_POST['pengguna_id'])) {
            Flasher::setFlash("danger", 'Petugas dengan username <strong>"' . $_POST['username'] . '"</strong> sudah ada');
            redirect("petugas/edit/$_POST[id]");
        } else if($this->model('PetugasModel')->findPetugasByNamaExceptThisId($_POST['nama'], $_POST['id'])) {
            Flasher::setFlash("danger", 'Petugas dengan nama <strong>"' . $_POST['nama'] . '"</strong> sudah ada');
            redirect("petugas/edit/$_POST[id]");
        } else {
            if($this->model('PetugasModel')->update($_POST) > 0) {
                Flasher::setFlash("success", "Data petugas berhasil diubah");
                redirect("petugas");
            } else {
                Flasher::setFlash("danger", "Data petugas gagal diubah");
                redirect("petugas/edit/$_POST[id]");
            }
        }
    }

    public function destroy()
    {    
        if(!$_POST) return redirect('petugas');

        if($this->model('PetugasModel')->destroy($_POST['id']) > 0) {
            Flasher::setFlash("success", "Data petugas berhasil dihapus");
            redirect("petugas");
        } else {
            Flasher::setFlash("danger", "Data petugas gagal dihapus");
            redirect("petugas");
        }
    }
}