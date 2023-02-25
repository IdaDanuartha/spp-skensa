<?php

class Kelas extends Controller {
    public function index()
    {         
        Middleware::onlyLoggedIn();   
        $data = [
            "view" => "pages/kelas/index",
            "kelas" => $this->model("KelasModel")->getAllKelas()
        ];

        return $this->view("layouts/dashboard", $data);
    }

    public function create()
    {
        Middleware::onlyLoggedIn();
        $data = [
            "view" => "pages/kelas/create",
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function store()
    {
        if(!$_POST) return redirect('kelas');

        if($this->model('KelasModel')->store($_POST) > 0) {
            Flasher::setFlash("success", "Data kelas berhasil ditambahkan");
            redirect("kelas");
        } else {
            Flasher::setFlash("danger", "Data kelas gagal ditambahkan");
            redirect("kelas/create");
        }
    }

    public function detail($id)
    {
        Middleware::onlyLoggedIn();    
       
        echo json_encode($this->model('KelasModel')->findKelas($id));
    }

    public function edit($id)
    {
        Middleware::onlyLoggedIn();
        $data = [
            "view" => "pages/kelas/edit",
            "kelas" => $this->model('KelasModel')->findKelas($id)
        ];
       
        return $this->view('layouts/dashboard', $data);
    }

    public function update()
    {
        if(!$_POST) return redirect('kelas');

        if($this->model('KelasModel')->update($_POST) > 0) {
            Flasher::setFlash("success", "Data kelas berhasil diubah");
            redirect("kelas");
        } else {
            Flasher::setFlash("danger", "Data kelas gagal diubah");
            redirect("kelas/edit/$_POST[id]");
        }
    }
}