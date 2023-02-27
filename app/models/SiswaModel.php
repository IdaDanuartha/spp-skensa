<?php

/**
 * class SiswaModel
 */

class SiswaModel extends Model {
    public function getAllSiswa()
    {
        return $this->db->query("SELECT siswa.*, kelas.nama AS kelas, pembayaran.tahun_ajaran AS tahun_ajaran FROM siswa
                                INNER JOIN kelas ON kelas.id = siswa.kelas_id
                                INNER JOIN pembayaran ON pembayaran.id = siswa.pembayaran_id
                                ORDER BY siswa.id DESC")->all();
    }

    public function getLatestPengguna()
    {
        return $this->db->query("SELECT * FROM pengguna ORDER BY id DESC LIMIT 1")->first();
    }

    public function findSiswaByColumn($column)
    {
        $siswa = [
            "nisn" => $column,
            "nis" => $column,
            "nama" => $column,
        ];
        
        return $this->db->query("SELECT * FROM siswa WHERE nisn=:nisn OR nis=:nis OR nama=:nama")
                        ->binds($siswa)
                        ->first();
    }

    public function findSiswaByColumnExceptThisId($column, $id)
    {
        $siswa = [
            "nisn" => $column,
            "nis" => $column,
            "nama" => $column,
            "id" => $id,
        ];

        return $this->db->query("SELECT * FROM siswa WHERE NOT id=:id AND nisn=:nisn OR nis=:nis OR nama=:nama")
                        ->binds($siswa)
                        ->first();
    }

    public function storeAccount($data)
    {
        $hash = password_hash($data['password'], PASSWORD_BCRYPT);
        $pengguna = [
            'username' => $data['nis'],
            'password' => $hash
        ];

        $this->db->query("INSERT INTO pengguna VALUES(null, :username, :password, 'siswa')")
                 ->binds($pengguna)->execute();   
    }

    public function findAccountSiswa($id)
    {
        return $this->db->query("SELECT * FROM pengguna WHERE id=:id")
                        ->bind("id", $id)
                        ->first();
    }

    public function updateAccount($data)
    {        
        $old_password = $this->findAccountSiswa($data['pengguna_id'])['password'];
        $hash = password_hash($data['password'], PASSWORD_BCRYPT);
        $pengguna = [
            'username' => $data['nis'],
            'password' => $data['password'] ? $hash : $old_password,
            'id' => $data['pengguna_id']
         ];

        $this->db->query("UPDATE pengguna SET username=:username, password=:password WHERE id=:id")
                 ->binds($pengguna)->execute();
    }

    public function store($data)
    {                              
        try {
            $this->storeAccount($data);
            $pengguna_id = $this->getLatestPengguna()['id'];

            $siswa = [
                "nisn" => $data['nisn'],
                "nis" => $data['nis'],
                "nama" => $data['nama'],
                "alamat" => $data['alamat'],
                "telepon" => $data['telepon'],
                "kelas_id" => $data['kelas_id'],
                "pengguna_id" => $pengguna_id,
                "pembayaran_id" => $data['pembayaran_id'],
            ];

            $this->db->query("INSERT INTO siswa VALUES(null, :nisn, :nis, :nama, :alamat, :telepon, :kelas_id, :pengguna_id, :pembayaran_id)")
                     ->binds($siswa)->execute();

            return $this->db->commit();
        } catch (\Exception $e) {            
            return $this->db->rollBack();
        }
    }

    public function findSiswa($id)
    {
        return $this->db->query("SELECT * FROM siswa WHERE id=:id")
                        ->bind("id", $id)
                        ->first();
    }

    public function update($data)
    {        
        try {
            $this->updateAccount($data);

            $siswa = [
                "nisn" => $data['nisn'],
                "nis" => $data['nis'],
                "nama" => $data['nama'],
                "alamat" => $data['alamat'],
                "telepon" => $data['telepon'],
                "kelas_id" => $data['kelas_id'],
                "pembayaran_id" => $data['pembayaran_id'],
                "id" => $data['id'],
            ];
            
            $this->db->query("UPDATE siswa SET nisn=:nisn, nis=:nis, nama=:nama, alamat=:alamat, telepon=:telepon, kelas_id=:kelas_id, pembayaran_id=:pembayaran_id WHERE id=:id")
                     ->binds($siswa)->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }

    public function destroy($id)
    {        
        try {            
            $this->db->query("DELETE FROM siswa WHERE id=:id")
                     ->bind("id", $id)
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }
}