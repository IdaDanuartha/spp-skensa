<?php

/**
 * class PenggunaModel
 */

class PenggunaModel {
    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findPenggunaByUsername($username)
    {
        return $this->db->query("SELECT * FROM pengguna WHERE username=:username")
                ->bind("username", $username)
                ->first();
    }

    public function findSiswaByPenggunaId($pengguna_id)
    {
        return $this->db->query("SELECT * FROM siswa WHERE pengguna_id=:pengguna_id")
                ->bind("pengguna_id", $pengguna_id)
                ->first();
    }

    public function login($data)
    {
        $pengguna = $this->findPenggunaByUsername($data['username']);
        $siswa = $this->findSiswaByPenggunaId($pengguna['id']);

        if(!$pengguna) return false;

        if(password_verify($pengguna['password'], $data['password'])) {
            $_SESSION['user'] = $siswa ?? $pengguna;
        } else {
            return false;
        }
    }


}