<?php

/**
 * class PembayaranModel
 */

class PembayaranModel extends Model {
    public function getAllPembayaran()
    {
        return $this->db->query("SELECT * FROM pembayaran ORDER BY pembayaran.id DESC")->all();
    }

    public function findPembayaranByTahunAjaran($tahun_ajaran)
    {
        return $this->db->query("SELECT * FROM pembayaran WHERE tahun_ajaran=:tahun_ajaran")
                        ->bind('tahun_ajaran', $tahun_ajaran)
                        ->first();
    }

    public function findPembayaranByTahunAjaranExceptThisId($tahun_ajaran, $id)
    {
        $pembayaran = [
            'tahun_ajaran' => $tahun_ajaran,
            'id' => $id
        ];

        return $this->db->query("SELECT * FROM pembayaran WHERE tahun_ajaran=:tahun_ajaran AND NOT id=:id")
                        ->binds($pembayaran)
                        ->first();
    }

    public function store($data)
    {
        try {     
            $pembayaran = [
                'tahun_ajaran' => $data['tahun_ajaran'],
                'nominal' => $data['nominal']
            ];

            $this->db->query("INSERT INTO pembayaran VALUES(null, :tahun_ajaran, :nominal)")
                     ->binds($pembayaran)
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }

    public function findPembayaran($id)
    {
        return $this->db->query("SELECT * FROM pembayaran WHERE id=:id")
                        ->bind("id", $id)
                        ->first();
    }

    public function update($data)
    {
        try {        
            $pembayaran = [
                'tahun_ajaran' => $data['tahun_ajaran'],
                'id' => $data['id']
            ];

            $this->db->query("UPDATE pembayaran SET tahun_ajaran=:tahun_ajaran WHERE id=:id")
                     ->binds($pembayaran)
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }

    public function destroy($data)
    {
        try {            
            $this->db->query("DELETE FROM pembayaran WHERE id=:id")
                     ->bind("id", $data['id'])
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }
}