<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_validasi extends CI_Model {

    /**
     * Mengecek dan memvalidasi kode tiket
     */
    public function validasi_tiket($kode_tiket, $id_petugas)
    {
        // 1. Cari tiket berdasarkan kodenya
        $this->db->where('kode_tiket', $kode_tiket);
        $query = $this->db->get('tbl_tiket');
        $tiket = $query->row_array();

        // 2. Jika tiket tidak ditemukan
        if ( ! $tiket) {
            return [
                'status' => 'error',
                'message' => 'Tiket Tidak Ditemukan! (Kode: ' . html_escape($kode_tiket) . ')'
            ];
        }

        // 3. Jika tiket ditemukan, cek statusnya
        if ($tiket['status_tiket'] == 'SUDAH_DIPAKAI') {
            return [
                'status' => 'warning',
                'message' => 'TIKET SUDAH DIGUNAKAN! (Pada: ' . $tiket['waktu_validasi'] . ')',
                'data' => $this->get_detail_tiket($tiket['id_transaksi']) 
            ];
        }

        // 4. Jika tiket BELUM_DIPAKAI (Valid)
        $data_update = [
            'status_tiket' => 'SUDAH_DIPAKAI',
            'waktu_validasi' => date('Y-m-d H:i:s'),
            'id_user_petugas' => $id_petugas
        ];
        $this->db->where('id_tiket', $tiket['id_tiket']);
        $this->db->update('tbl_tiket', $data_update);

        // Kirim balasan sukses
        return [
            'status' => 'sukses',
            'message' => 'BERHASIL. Selamat Datang!',
            'data' => $this->get_detail_tiket($tiket['id_transaksi']) 
        ];
    }

    /**
     * Helper untuk mengambil detail transaksi untuk ditampilkan di notifikasi
     */
    public function get_detail_tiket($id_transaksi)
    {
        $this->db->select('o.nama_objek, SUM(td.jumlah) as total_pengunjung');
        $this->db->from('tbl_transaksi t');
        $this->db->join('tbl_objek_wisata o', 't.id_objek = o.id_objek');
        $this->db->join('tbl_transaksi_detail td', 't.id_transaksi = td.id_transaksi');
        // [PERBAIKAN] Mengganti $this. menjadi $this->
        $this->db->where('t.id_transaksi', $id_transaksi);
        $this->db->group_by('o.nama_objek');
        
        return $this->db->get()->row_array();
    }
}