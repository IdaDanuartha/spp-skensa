<?php

/**
 * class SiswaModel
 */

class SiswaModel extends Model {
    public function dataSiswa($data)
    {
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

        return $siswa;
    }
    
    public function getAllSiswa()
    {
        return $this->db->query("SELECT siswa.*, kelas.nama AS kelas, pembayaran.tahun_ajaran AS tahun_ajaran FROM siswa
                                INNER JOIN kelas ON kelas.id = siswa.kelas_id
                                INNER JOIN pembayaran ON pembayaran.id = siswa.pembayaran_id
                                ORDER BY pembayaran.id DESC")->all();
    }

    public function getLatestPengguna()
    {
        return $this->db->query("SELECT * FROM pengguna ORDER BY id DESC LIMIT 1")->first();
    }

    public function findSiswaByColumn($column)
    {
        return $this->db->query("SELECT * FROM siswa WHERE nisn=:nisn OR nis=:nis OR nama=:nama")
                        ->bind('nisn', $column)
                        ->bind('nis', $column)
                        ->bind('nama', $column)
                        ->first();
    }

    public function findSiswaByColumnExceptThisId($column, $id)
    {
        return $this->db->query("SELECT * FROM siswa WHERE nisn=:nisn OR nis=:nis OR nama=:nama AND NOT id=:id")
                        ->bind('nisn', $column)
                        ->bind('nis', $column)
                        ->bind('nama', $column)
                        ->bind('id', $id)
                        ->first();
    }

    public function store($data)
    {
        try {
            $this->db->beginTransaction();            

            $this->db->query("INSERT INTO siswa VALUES(null, :nisn, :nis, :nama, :alamat, :telepon, :kelas_id, :pengguna_id, :pembayaran_id)")
                     ->binds($this->dataSiswa($data))
                     ->execute();
                     
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
            $this->db->beginTransaction();

            $siswa = [
                "nisn" => $data['nisn'],
                "nis" => $data['nis'],
                "nama" => $data['nama'],
                "alamat" => $data['alamat'],
                "telepon" => $data['telepon'],
                "kelas_Id" => $data['kelas_Id'],
                "pengguna_id" => $data['pengguna_id'],
                "pembayaran_id" => $data['pembayaran_id'],
            ];

            $this->db->query("UPDATE siswa SET tahun_ajaran=:tahun_ajaran WHERE id=:id")
                     ->bind("tahun_ajaran", $data['tahun_ajaran'])                     
                     ->bind("id", $data['id'])
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }

    public function destroy($data)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("DELETE FROM siswa WHERE id=:id")
                     ->bind("id", $data['id'])
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }
}