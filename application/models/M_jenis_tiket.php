<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jenis_tiket extends CI_Model {

    /**
     * Mengambil semua data jenis tiket
     */
    public function get_all_tiket()
    {
        $this->db->order_by('id_jenis_tiket', 'DESC'); // Urutkan berdasarkan ID terbaru
        $query = $this->db->get('tbl_jenis_tiket');
        return $query->result_array();
    }

    /**
     * Menyimpan data kategori tiket baru ke database
     */
    public function tambah_tiket($data)
    {
        return $this->db->insert('tbl_jenis_tiket', $data);
    }

    /**
     * Mengambil satu data kategori tiket berdasarkan ID
     */
    public function get_tiket_by_id($id_tiket)
    {
        $this->db->where('id_jenis_tiket', $id_tiket);
        $query = $this->db->get('tbl_jenis_tiket');
        return $query->row_array(); // Kembalikan 1 baris data
    }

    /**
     * Memperbarui data kategori tiket di database
     */
    public function update_tiket($id_tiket, $data)
    {
        $this->db->where('id_jenis_tiket', $id_tiket);
        return $this->db->update('tbl_jenis_tiket', $data);
    }

    /**
     * Menghapus data kategori tiket berdasarkan ID
     */
    public function hapus_tiket($id_tiket)
    {
        $this->db->where('id_jenis_tiket', $id_tiket);
        return $this->db->delete('tbl_jenis_tiket');
    }

    // (Nanti kita tambahkan fungsi tambah_tiket, edit_tiket, hapus_tiket di sini)
}