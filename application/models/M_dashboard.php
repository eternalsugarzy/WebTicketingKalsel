<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    /**
     * Mengambil data total pengunjung per kabupaten
     * Kita akan join 4 tabel untuk mendapatkan data ini:
     * tbl_transaksi_detail (untuk sum jumlah)
     * -> tbl_transaksi (untuk id_objek)
     * -> tbl_objek_wisata (untuk id_kabupaten)
     * -> tbl_kabupaten (untuk nama_kabupaten)
     */
    public function get_pengunjung_per_kabupaten()
    {
        $this->db->select('tbl_kabupaten.nama_kabupaten, SUM(tbl_transaksi_detail.jumlah) as total_pengunjung');
        $this->db->from('tbl_transaksi_detail');
        $this->db->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_transaksi_detail.id_transaksi');
        $this->db->join('tbl_objek_wisata', 'tbl_objek_wisata.id_objek = tbl_transaksi.id_objek');
        $this->db->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_objek_wisata.id_kabupaten');
        
        // Mengelompokkan hasil berdasarkan nama kabupaten
        $this->db->group_by('tbl_kabupaten.nama_kabupaten');
        // Mengurutkan dari yang paling banyak pengunjungnya
        $this->db->order_by('total_pengunjung', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan sebagai array
    }

    // (Nanti kita bisa tambahkan fungsi lain di sini, 
    // misal 'get_total_penjualan_hari_ini')
}