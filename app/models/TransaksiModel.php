<?php

/**
 * class TransaksiModel
 */

class TransaksiModel extends Model {
    public function getAllTransaksi()
    {
        return $this->db->query("SELECT transaksi.*, siswa.nama AS nama_siswa, petugas.nama AS nama_petugas, pembayaran.nominal FROM transaksi
                                INNER JOIN siswa ON siswa.id = transaksi.siswa_id
                                INNER JOIN petugas ON petugas.id = transaksi.petugas_id
                                INNER JOIN pembayaran ON pembayaran.id = transaksi.pembayaran_id")->all();
    } 

    public function getAllTransaksiSiswa($siswa_id)
    {
        return $this->db->query("SELECT transaksi.*, petugas.nama AS nama_petugas, pembayaran.nominal FROM transaksi
                                INNER JOIN petugas ON petugas.id = transaksi.petugas_id
                                INNER JOIN pembayaran ON pembayaran.id = transaksi.pembayaran_id
                                WHERE siswa_id=:siswa_id")
                        ->bind("siswa_id", $siswa_id)
                        ->all();
    } 

    public function getTransaksiSiswaThisYear($siswa_id)
    {
        $transaksi = [
            "siswa_id" => $siswa_id,
            "tahun_dibayar" => date('Y')
        ];

        return $this->db->query("SELECT * FROM transaksi WHERE siswa_id=:siswa_id AND tahun_dibayar=:tahun_dibayar")
                        ->binds($transaksi)
                        ->all();
    } 

    public function getTransaksiByDate($start_date, $end_date)
    {
        $transaksi = [
            "start_date" => $start_date,
            "end_date" => $end_date
        ];

        return $this->db->query("SELECT transaksi.*, siswa.nama AS nama_siswa, petugas.nama AS nama_petugas, pembayaran.nominal FROM transaksi
                                INNER JOIN siswa ON siswa.id = transaksi.siswa_id
                                INNER JOIN petugas ON petugas.id = transaksi.petugas_id
                                INNER JOIN pembayaran ON pembayaran.id = transaksi.pembayaran_id 
                                WHERE transaksi.tanggal_bayar BETWEEN :start_date AND :end_date")
                        ->binds($transaksi)
                        ->all();
    } 
    
    public function findTransaksiByMonth($bulan_dibayar, $siswa_id)
    {
        $transaksi = [
            "bulan_dibayar" => $bulan_dibayar,
            "tahun_dibayar" => date('Y'),
            "siswa_id" => $siswa_id,
        ];

        return $this->db->query("SELECT * FROM transaksi WHERE bulan_dibayar=:bulan_dibayar AND tahun_dibayar=:tahun_dibayar AND siswa_id=:siswa_id")
                        ->binds($transaksi)
                        ->first();
    }

    public function store($data)
    {                              
        try {
            $siswa = [
                "tanggal_bayar" => $data['tanggal_bayar'],
                "bulan_dibayar" => $data['bulan_dibayar'],
                "tahun_dibayar" => date("Y"),
                "siswa_id" => $data['siswa_id'],
                "petugas_id" => $_SESSION['user']['id'],
                "pembayaran_id" => $data['pembayaran_id'],                
            ];

            $this->db->query("INSERT INTO transaksi VALUES(null, :tanggal_bayar, :bulan_dibayar, :tahun_dibayar, :siswa_id, :petugas_id, :pembayaran_id)")
                     ->binds($siswa)
                     ->execute();

            return $this->db->commit();
        } catch (\Exception $e) {            
            return $this->db->rollBack();
        }
    }

    public function destroy($id)
    {
        try {            
            $this->db->query("DELETE FROM transaksi WHERE id=:id")
                     ->bind("id", $id)
                     ->execute();
                     
            return $this->db->commit();
        } catch (\Exception $e) {
            return $this->db->rollBack();
        }
    }
}