<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    /**
     * Mengambil semua data user dari tabel tbl_user
     */
    public function get_all_users()
    {
        // Mengurutkan berdasarkan id_user secara descending (terbaru dulu)
        $this->db->order_by('id_user', 'DESC');
        $query = $this->db->get('tbl_user');
        return $query->result_array();
    }

    /**
     * Menyimpan data user baru ke database
     */
    public function tambah_user($data)
    {
        // Parameter $data adalah array yang berisi data
        // yang akan di-insert (nama_lengkap, username, password, level)
        return $this->db->insert('tbl_user', $data);
    }

    /**
     * Mengambil satu data user berdasarkan ID
     */
    public function get_user_by_id($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tbl_user');
        return $query->row_array(); // Kembalikan 1 baris data
    }

    /**
     * Memperbarui data user di database
     */
    public function update_user($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->update('tbl_user', $data);
    }

    /**
     * Menghapus data user berdasarkan ID
     */
    public function hapus_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->delete('tbl_user');
    }
}