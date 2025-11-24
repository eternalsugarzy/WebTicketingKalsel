<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengunjung extends CI_Model {

    // Terima parameter filter (default null jika tidak ada filter)
    public function get_all_pengunjung($tgl_awal = null, $tgl_akhir = null, $id_objek = null, $id_kabupaten = null)
    {
        // Pilih kolom, tambah nama_kabupaten
        $this->db->select('tbl_transaksi.*, tbl_objek_wisata.nama_objek, tbl_kabupaten.nama_kabupaten, SUM(tbl_transaksi_detail.jumlah) as total_pengunjung');
        
        $this->db->from('tbl_transaksi'); 
        
        // Join Objek Wisata
        $this->db->join('tbl_objek_wisata', 'tbl_transaksi.id_objek = tbl_objek_wisata.id_objek');
        
        // Join Kabupaten (lewat tabel objek wisata)
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten', 'left');

        // Join Detail Transaksi
        $this->db->join('tbl_transaksi_detail', 'tbl_transaksi.id_transaksi = tbl_transaksi_detail.id_transaksi', 'left');
        
        // --- LOGIKA FILTER ---
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('DATE(waktu_transaksi) >=', $tgl_awal);
            $this->db->where('DATE(waktu_transaksi) <=', $tgl_akhir);
        }

        if (!empty($id_objek)) {
            $this->db->where('tbl_transaksi.id_objek', $id_objek);
        }

        if (!empty($id_kabupaten)) {
            $this->db->where('tbl_objek_wisata.id_kabupaten', $id_kabupaten);
        }
        // ---------------------

        $this->db->group_by('tbl_transaksi.id_transaksi');
        $this->db->order_by('waktu_transaksi', 'DESC'); 
        
        return $this->db->get()->result();
    }
}