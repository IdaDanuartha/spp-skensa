<?php

/**
 * class KelasModel
 */

class KelasModel {
    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllKelas()
    {
        return $this->db->query("SELECT kelas.*, COUNT(siswa.id) AS total_siswa FROM kelas
                                LEFT JOIN siswa ON siswa.kelas_id = kelas.id
                                GROUP BY kelas.id
                                ORDER BY kelas.id DESC")->all();
    }

    public function store($data)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("call insertKelas(:nama, :kompetensi_keahlian)")
                     ->bind("nama", $data['nama'])
                     ->bind("kompetensi_keahlian", $data['kompetensi_keahlian'])
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
            $this->db->beginTransaction();

            $this->db->query("call updateKelas(:nama, :kompetensi_keahlian, :id)")
                     ->bind("nama", $data['nama'])
                     ->bind("kompetensi_keahlian", $data['kompetensi_keahlian'])
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

            $this->db->query("call deleteKelas(:id)")
                     ->bind("id", $data['id'])
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }
}