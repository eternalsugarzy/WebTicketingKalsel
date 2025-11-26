<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengunjung extends CI_Model {

    public function get_all_pengunjung($tgl_awal = null, $tgl_akhir = null, $id_objek = null, $id_kabupaten = null)
    {
        $this->db->select('
            tbl_transaksi.id_transaksi, 
            tbl_objek_wisata.nama_objek, 
            tbl_kabupaten.nama_kabupaten, 
            tbl_tiket.waktu_validasi AS waktu_transaksi, 
            SUM(tbl_transaksi_detail.jumlah) AS total_pengunjung, 
            tbl_transaksi.status_transaksi
        ');
        
        $this->db->from('tbl_transaksi'); 
        
        $this->db->join('tbl_objek_wisata', 'tbl_transaksi.id_objek = tbl_objek_wisata.id_objek');
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten', 'left');
        $this->db->join('tbl_transaksi_detail', 'tbl_transaksi.id_transaksi = tbl_transaksi_detail.id_transaksi', 'left');
        $this->db->join('tbl_tiket', 'tbl_transaksi.id_transaksi = tbl_tiket.id_transaksi');
        
        // Hanya tiket yang sudah dipakai
        $this->db->where('tbl_tiket.status_tiket', 'SUDAH_DIPAKAI');

        // Filter tanggal
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('DATE(tbl_tiket.waktu_validasi) >=', $tgl_awal);
            $this->db->where('DATE(tbl_tiket.waktu_validasi) <=', $tgl_akhir);
        }

        // Filter objek wisata
        if (!empty($id_objek)) {
            $this->db->where('tbl_transaksi.id_objek', $id_objek);
        }

        // Filter kabupaten
        if (!empty($id_kabupaten)) {
            $this->db->where('tbl_objek_wisata.id_kabupaten', $id_kabupaten);
        }

        // ✅ GROUP BY LENGKAP (SOLUSI ERROR 1055)
        $this->db->group_by('
            tbl_transaksi.id_transaksi,
            tbl_objek_wisata.nama_objek,
            tbl_kabupaten.nama_kabupaten,
            tbl_tiket.waktu_validasi,
            tbl_transaksi.status_transaksi
        ');
        
        // Urutkan berdasarkan waktu transaksi terbaru
        $this->db->order_by('tbl_tiket.waktu_validasi', 'DESC'); 
        
        return $this->db->get()->result();
    }

}
