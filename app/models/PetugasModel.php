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
        return $this->db->query("SELECT * FROM pengguna WHERE NOT id=:id AND username=:username")
                        ->bind('username', $username)
                        ->bind('id', $id)
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
        return $this->db->query("SELECT * FROM petugas WHERE NOT id=:id AND nama=:nama")
                        ->bind('nama', $nama)
                        ->bind('id', $id)
                        ->first();
    }

    public function storeAccount($data)
    {
        $hash = password_hash($data['password'], PASSWORD_BCRYPT);

        $this->db->query("INSERT INTO pengguna VALUES(null, :username, :password, 'petugas')")
                 ->binds([
                    'username' => $data['username'],
                    'password' => $hash
                 ])->execute();     
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

        $this->db->query("UPDATE pengguna SET username=:username, password=:password WHERE id=:id")
                 ->binds([
                    'username' => $data['username'],
                    'password' => $data['password'] ? $hash : $old_password,
                    'id' => $data['pengguna_id']
                 ])->execute();
    }

    public function store($data)
    {           
        try {                        
            $this->storeAccount($data);
            $pengguna_id = $this->getLatestPengguna()['id'];

            $this->db->query("INSERT INTO petugas VALUES(null, :nama, :pengguna_id)")
                     ->binds([
                        "nama" => $data['nama'],
                        "pengguna_id" => $pengguna_id,
                    ])->execute();

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
            $this->db->query("UPDATE petugas SET nama=:nama WHERE id=:id")
                     ->binds([
                        "nama" => $data['nama'],
                        "id" => $data['id'],
                     ])->execute();
                     
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