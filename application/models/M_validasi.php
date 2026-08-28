<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_validasi extends CI_Model {

    /**
     * Validasi dan memproses scan kode tiket (atomic)
     */
    public function validasi_tiket($kode_tiket, $id_petugas)
    {
        // Atomic update: hanya update jika status masih BELUM_DIPAKAI
        $this->db->where('kode_tiket', $kode_tiket);
        $this->db->where('status_tiket', 'BELUM_DIPAKAI');
        $this->db->set('status_tiket', 'SUDAH_DIPAKAI');
        $this->db->set('waktu_validasi', date('Y-m-d H:i:s'));
        $this->db->set('id_user_petugas', $id_petugas);
        $this->db->update('tbl_tiket');

        $affected_rows = $this->db->affected_rows();

        if ($affected_rows > 0) {
            // Sukses: tiket berhasil divalidasi
            return [
                'status' => 'sukses',
                'message' => 'BERHASIL. Selamat Datang!',
                'data' => $this->get_detail_tiket_by_kode($kode_tiket)
            ];
        }

        // Cek apakah tiket ada
        $this->db->where('kode_tiket', $kode_tiket);
        $tiket = $this->db->get('tbl_tiket')->row_array();

        if ($tiket) {
            // Tiket sudah dipakai
            return [
                'status' => 'warning',
                'message' => 'TIKET SUDAH DIGUNAKAN! (Pada: ' . $tiket['waktu_validasi'] . ')',
                'data' => $this->get_detail_tiket($tiket['id_transaksi'])
            ];
        }

        // Tiket tidak ditemukan
        return [
            'status' => 'error',
            'message' => 'Tiket Tidak Ditemukan! (Kode: ' . html_escape($kode_tiket) . ')'
        ];
    }

    /**
     * Helper untuk mengambil detail transaksi berdasarkan kode tiket
     */
    public function get_detail_tiket_by_kode($kode_tiket)
    {
        $query = $this->db->query("
            SELECT 
                o.nama_objek,
                k.nama_kabupaten,
                SUM(td.jumlah) as total_pengunjung
            FROM tbl_tiket t
            JOIN tbl_transaksi tr ON t.id_transaksi = tr.id_transaksi
            JOIN tbl_objek_wisata o ON tr.id_objek = o.id_objek
            JOIN tbl_kabupaten k ON o.id_kabupaten = k.id_kabupaten
            JOIN tbl_transaksi_detail td ON tr.id_transaksi = td.id_transaksi
            WHERE t.kode_tiket = ?
            GROUP BY o.nama_objek, k.nama_kabupaten
        ", [$kode_tiket]);

        return $query->row_array();
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