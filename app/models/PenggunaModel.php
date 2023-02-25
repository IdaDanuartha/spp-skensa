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
        return $this->db->query("SELECT siswa.*, pengguna.username, pengguna.role FROM siswa
                                INNER JOIN pengguna ON pengguna.id = siswa.pengguna_id
                                WHERE pengguna_id=:pengguna_id")
                ->bind("pengguna_id", $pengguna_id)
                ->first();
    }

    public function login($data)
    {
        $pengguna = $this->findPenggunaByUsername($data['username']);
        if(!$pengguna) return false;

        $siswa = $this->findSiswaByPenggunaId($pengguna['id']);
        
        if(password_verify($data['password'], $pengguna['password'])) {
            $_SESSION['user'] = $siswa ? $siswa : $pengguna;
        } else {
            return false;
        }
    }


}