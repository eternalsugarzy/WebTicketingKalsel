<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengunjung extends CI_Model {

    public function get_all_pengunjung($tgl_awal = null, $tgl_akhir = null, $id_objek = null, $id_kabupaten = null)
    {
        // [PERBAIKAN] Hapus 'tbl_transaksi.no_transaksi' karena kolom tidak ada di database
        // Gunakan tbl_transaksi.id_transaksi saja
        $this->db->select('tbl_transaksi.id_transaksi, tbl_objek_wisata.nama_objek, tbl_kabupaten.nama_kabupaten, tbl_tiket.waktu_validasi as waktu_transaksi, SUM(tbl_transaksi_detail.jumlah) as total_pengunjung, tbl_transaksi.status_transaksi');
        
        $this->db->from('tbl_transaksi'); 
        
        // Join ke tabel-tabel lain
        $this->db->join('tbl_objek_wisata', 'tbl_transaksi.id_objek = tbl_objek_wisata.id_objek');
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten', 'left');
        $this->db->join('tbl_transaksi_detail', 'tbl_transaksi.id_transaksi = tbl_transaksi_detail.id_transaksi', 'left');
        
        // Join ke tabel tiket untuk cek status
        $this->db->join('tbl_tiket', 'tbl_transaksi.id_transaksi = tbl_tiket.id_transaksi');
        
        // HANYA ambil data yang status tiketnya 'SUDAH_DIPAKAI'
        $this->db->where('tbl_tiket.status_tiket', 'SUDAH_DIPAKAI');

        // Filter Tambahan
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('DATE(tbl_tiket.waktu_validasi) >=', $tgl_awal);
            $this->db->where('DATE(tbl_tiket.waktu_validasi) <=', $tgl_akhir);
        }

        if (!empty($id_objek)) {
            $this->db->where('tbl_transaksi.id_objek', $id_objek);
        }

        if (!empty($id_kabupaten)) {
            $this->db->where('tbl_objek_wisata.id_kabupaten', $id_kabupaten);
        }

        // Group by transaksi
        $this->db->group_by('tbl_transaksi.id_transaksi');
        
        // Urutkan berdasarkan waktu scan terakhir
        $this->db->order_by('tbl_tiket.waktu_validasi', 'DESC'); 
        
        return $this->db->get()->result();
    }
}