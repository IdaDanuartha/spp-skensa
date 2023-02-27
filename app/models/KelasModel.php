<?php

/**
 * class KelasModel
 */

class KelasModel extends Model {
    public function getAllKelas()
    {
        return $this->db->query("SELECT kelas.*, COUNT(siswa.id) AS total_siswa FROM kelas
                                LEFT JOIN siswa ON siswa.kelas_id = kelas.id
                                GROUP BY kelas.id
                                ORDER BY kelas.id DESC")->all();
    }

    public function findKelasByNama($nama)
    {
        return $this->db->query("SELECT * FROM kelas WHERE nama=:nama")
                        ->bind('nama', $nama)
                        ->first();
    }

    public function findKelasByNamaExceptThisId($nama, $id)
    {
        $kelas = [
            'nama' => $nama,
            'id' => $id
        ];

        return $this->db->query("SELECT * FROM kelas WHERE nama=:nama AND NOT id=:id")
                        ->binds($kelas)
                        ->first();
    }

    public function store($data)
    {
        try {           
            $kelas = [
                'nama' => $data['nama'],
                'kompetensi_keahlian' => $data['kompetensi_keahlian']
            ];

            $this->db->query("call insertKelas(:nama, :kompetensi_keahlian)")
                     ->binds($kelas)
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }

    public function findKelas($id)
    {
        return $this->db->query("call editKelas(:id)")
                        ->bind("id", $id)
                        ->first();
    }

    public function update($data)
    {
        try {        
            $kelas = [
                'nama' => $data['nama'],
                'kompetensi_keahlian' => $data['kompetensi_keahlian'],
                'id' => $data['id']
            ];

            $this->db->query("call updateKelas(:nama, :kompetensi_keahlian, :id)")
                     ->binds($kelas)
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }

    public function destroy($id)
    {
        try {                        
            $this->db->query("call deleteKelas(:id)")
                     ->bind("id", $id)
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }
}