<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_objek_wisata extends CI_Model {

    /**
     * [PERUBAHAN] Fungsi ini sekarang menerima 2 parameter opsional
     * $filter_kabupaten = id_kabupaten
     * $search_query = string nama objek
     */
    public function get_all_objek($filter_kabupaten = null, $search_query = null)
    {
        $this->db->select('tbl_objek_wisata.*, tbl_kabupaten.nama_kabupaten');
        $this->db->from('tbl_objek_wisata');
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten');

        // [BARU] Menambahkan filter jika $filter_kabupaten diisi
        if ($filter_kabupaten) {
            $this->db->where('tbl_objek_wisata.id_kabupaten', $filter_kabupaten);
        }

        // [BARU] Menambahkan pencarian jika $search_query diisi
        if ($search_query) {
            $this->db->like('tbl_objek_wisata.nama_objek', $search_query);
        }
        
        $this->db->order_by('id_objek', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Mengambil semua data kabupaten untuk dropdown
     */
    public function get_all_kabupaten()
    {
        $this->db->order_by('nama_kabupaten', 'ASC');
        $query = $this->db->get('tbl_kabupaten');
        return $query->result_array();
    }

    /**
     * Menyimpan data objek wisata baru ke database
     */
    public function tambah_objek($data)
    {
        return $this->db->insert('tbl_objek_wisata', $data);
    }

    /**
     * Mengambil satu data objek wisata berdasarkan ID
     */
    public function get_objek_by_id($id_objek)
    {
        $this->db->where('id_objek', $id_objek);
        $query = $this->db->get('tbl_objek_wisata');
        return $query->row_array(); // Kembalikan 1 baris data
    }

    /**
     * Memperbarui data objek wisata di database
     */
    public function update_objek($id_objek, $data)
    {
        $this->db->where('id_objek', $id_objek);
        return $this->db->update('tbl_objek_wisata', $data);
    }

    /**
     * Menghapus data objek wisata berdasarkan ID
     */
    public function hapus_objek($id_objek)
    {
        $this->db->where('id_objek', $id_objek);
        return $this->db->delete('tbl_objek_wisata');
    }

    /**
     * [FUNGSI BARU] Mengambil satu data kabupaten berdasarkan ID
     */
    public function get_kabupaten_by_id($id_kabupaten)
    {
        $this->db->where('id_kabupaten', $id_kabupaten);
        $query = $this->db->get('tbl_kabupaten');
        return $query->row_array();
    }
}