<?php

/**
 * class PetugasModel
 */

class PetugasModel extends Model {
    public function getAllPetugas()
    {
        return $this->db->query("SELECT petugas.*, pengguna.username FROM petugas 
                                INNER JOIN pengguna ON pengguna.id = petugas.pengguna_id
                                WHERE NOT nama = 'Admin'
                                ORDER BY petugas.id DESC")->all();
    }

    public function getLatestPengguna()
    {
        return $this->db->query("SELECT * FROM pengguna ORDER BY id DESC LIMIT 1")->first();
    }

    public function findAccountPetugasByUsername($username)
    {
        return $this->db->query("SELECT * FROM pengguna WHERE username=:username")
                        ->bind('username', $username)
                        ->first();
    }

    public function findAccountPetugasByUsernameExceptThisId($username, $id)
    {
        $petugas = [
            'username' => $username,
            'id' => $id
        ];

        return $this->db->query("SELECT * FROM pengguna WHERE NOT id=:id AND username=:username")
                        ->binds($petugas)
                        ->first();
    }

    public function findPetugasByNama($column)
    {
        return $this->db->query("SELECT * FROM petugas WHERE nama=:nama")
                        ->bind('nama', $column)
                        ->first();
    }

    public function findPetugasByNamaExceptThisId($nama, $id)
    {
        $petugas = [
            'nama' => $nama,
            'id' => $id
        ];

        return $this->db->query("SELECT * FROM petugas WHERE NOT id=:id AND nama=:nama")
                        ->binds($petugas)
                        ->first();
    }

    public function storeAccount($data)
    {
        $hash = password_hash($data['password'], PASSWORD_BCRYPT);
        $pengguna = [
            'username' => $data['username'],
            'password' => $hash
        ];

        $this->db->query("INSERT INTO pengguna VALUES(null, :username, :password, 'petugas')")
                 ->binds($pengguna)
                 ->execute();     
    }

    public function findAccountPetugas($id)
    {
        return $this->db->query("SELECT * FROM pengguna WHERE id=:id")
                        ->bind("id", $id)
                        ->first();
    }

    public function updateAccount($data)
    {        
        $old_password = $this->findAccountPetugas($data['pengguna_id'])['password'];
        $hash = password_hash($data['password'], PASSWORD_BCRYPT);
        $pengguna = [
            'username' => $data['username'],
            'password' => $data['password'] ? $hash : $old_password,
            'id' => $data['pengguna_id']
        ];

        $this->db->query("UPDATE pengguna SET username=:username, password=:password WHERE id=:id")
                 ->binds($pengguna)
                 ->execute();
    }

    public function store($data)
    {           
        try {                        
            $this->storeAccount($data);
            $pengguna_id = $this->getLatestPengguna()['id'];
            $petugas = [
                "nama" => $data['nama'],
                "pengguna_id" => $pengguna_id,
            ];

            $this->db->query("INSERT INTO petugas VALUES(null, :nama, :pengguna_id)")
                     ->binds($petugas)
                     ->execute();

            return $this->db->commit();
        } catch (\Exception $e) {            
            return $this->db->rollBack();
        }
    }

    public function findPetugas($id)
    {
        return $this->db->query("SELECT petugas.*, pengguna.username FROM petugas
                                INNER JOIN pengguna ON pengguna.id = petugas.pengguna_id
                                WHERE petugas.id=:id")
                        ->bind("id", $id)
                        ->first();
    }

    public function update($data)
    {        
        try {
            $this->updateAccount($data);
            $petugas = [
                "nama" => $data['nama'],
                "id" => $data['id'],
            ];

            $this->db->query("UPDATE petugas SET nama=:nama WHERE id=:id")
                     ->binds($petugas)->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }

    public function destroy($id)
    {        
        try {            
            $this->db->query("DELETE FROM petugas WHERE id=:id")
                     ->bind("id", $id)
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }
}