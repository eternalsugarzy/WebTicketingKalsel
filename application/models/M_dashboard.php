<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function get_pengunjung_per_kabupaten($filter = 'tahun')
    {
        $this->db->select('tbl_kabupaten.nama_kabupaten, SUM(tbl_transaksi_detail.jumlah) as total_pengunjung');
        $this->db->from('tbl_transaksi_detail');
        $this->db->join('tbl_transaksi', 'tbl_transaksi_detail.id_transaksi = tbl_transaksi.id_transaksi');
        $this->db->join('tbl_objek_wisata', 'tbl_transaksi.id_objek = tbl_objek_wisata.id_objek');
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten');

        // --- LOGIKA FILTER WAKTU ---
        if ($filter == 'minggu') {
            // Data Minggu Ini
            $this->db->where('YEARWEEK(tbl_transaksi.waktu_transaksi, 1) = YEARWEEK(CURDATE(), 1)');
        } elseif ($filter == 'bulan') {
            // Data Bulan Ini
            $this->db->where('MONTH(tbl_transaksi.waktu_transaksi)', date('m'));
            $this->db->where('YEAR(tbl_transaksi.waktu_transaksi)', date('Y'));
        } elseif ($filter == 'tahun') {
            // Data Tahun Ini
            $this->db->where('YEAR(tbl_transaksi.waktu_transaksi)', date('Y'));
        }
        // ---------------------------

        $this->db->group_by('tbl_kabupaten.id_kabupaten');
        return $this->db->get()->result_array();
    }
}