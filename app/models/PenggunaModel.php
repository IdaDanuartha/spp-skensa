<?php

/**
 * class PenggunaModel
 */

class PenggunaModel extends Model {

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

    public function findPetugasByPenggunaId($pengguna_id)
    {
        return $this->db->query("SELECT petugas.*, pengguna.username, pengguna.role FROM petugas
                                INNER JOIN pengguna ON pengguna.id = petugas.pengguna_id
                                WHERE pengguna_id=:pengguna_id")
                        ->bind("pengguna_id", $pengguna_id)
                        ->first();
    }

    public function login($data)
    {
        $pengguna = $this->findPenggunaByUsername($data['username']);
        if(!$pengguna) return false;

        $siswa = $this->findSiswaByPenggunaId($pengguna['id']);
        $petugas = $this->findPetugasByPenggunaId($pengguna['id']);
        
        if(password_verify($data['password'], $pengguna['password'])) {
            $_SESSION['user'] = $siswa ? $siswa : $petugas;
            return true;
        } else {
            return false;
        }
    }


}