<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_harga_tiket extends CI_Model {

    // [MODIFIKASI] Menambahkan parameter $limit dan $start untuk pagination
    public function get_all_harga($filter_kategori = null, $search_query = null, $filter_objek = null, $limit = null, $start = null)
    {
        $this->db->select('
            tbl_harga_tiket.*, 
            tbl_objek_wisata.nama_objek, 
            tbl_jenis_tiket.nama_tiket
        ');
        $this->db->from('tbl_harga_tiket');
        $this->db->join('tbl_objek_wisata', 'tbl_harga_tiket.id_objek = tbl_objek_wisata.id_objek');
        $this->db->join('tbl_jenis_tiket', 'tbl_harga_tiket.id_jenis_tiket = tbl_jenis_tiket.id_jenis_tiket');

        // Logic Filter (Dipisah agar bisa dipakai ulang oleh fungsi hitung)
        $this->_apply_filters($filter_kategori, $search_query, $filter_objek);

        $this->db->order_by('id_harga', 'DESC');

        // [BARU] Limit Data untuk Pagination
        if ($limit) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    // [FUNGSI BARU] Menghitung Total Data (Penting untuk Pagination)
    public function count_all_harga($filter_kategori = null, $search_query = null, $filter_objek = null)
    {
        $this->db->from('tbl_harga_tiket');
        $this->db->join('tbl_objek_wisata', 'tbl_harga_tiket.id_objek = tbl_objek_wisata.id_objek');
        $this->db->join('tbl_jenis_tiket', 'tbl_harga_tiket.id_jenis_tiket = tbl_jenis_tiket.id_jenis_tiket');
        
        // Panggil filter yang sama
        $this->_apply_filters($filter_kategori, $search_query, $filter_objek);

        return $this->db->count_all_results();
    }

    // [HELPER PRIVATE] Agar logic filter tidak ditulis ulang 2 kali
    private function _apply_filters($filter_kategori, $search_query, $filter_objek) {
        if ($filter_kategori) {
            $this->db->where('tbl_harga_tiket.id_jenis_tiket', $filter_kategori);
        }
        if ($search_query) {
            $this->db->like('tbl_objek_wisata.nama_objek', $search_query);
        }
        if ($filter_objek) {
            $this->db->where('tbl_harga_tiket.id_objek', $filter_objek);
        }
    }

    // --- FUNGSI LAIN DI BAWAH INI TETAP SAMA SEPERTI SEBELUMNYA ---

    public function get_harga_with_objek($id_harga, $id_objek)
    {
        $this->db->where('id_harga', $id_harga);
        $this->db->where('id_objek', $id_objek);
        $query = $this->db->get('tbl_harga_tiket');
        return $query->row_array();
    }

    public function get_objek_wisata_list()
    {
        $this->db->select('tbl_objek_wisata.id_objek, tbl_objek_wisata.nama_objek, tbl_kabupaten.nama_kabupaten');
        $this->db->from('tbl_objek_wisata');
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten');
        $this->db->order_by('nama_objek', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_jenis_tiket_list()
    {
        $this->db->order_by('nama_tiket', 'ASC');
        $query = $this->db->get('tbl_jenis_tiket');
        return $query->result_array();
    }

    public function tambah_harga($data)
    {
        return $this->db->insert('tbl_harga_tiket', $data);
    }

    public function cek_duplikat($id_objek, $id_jenis_tiket, $id_harga = null)
    {
        $this->db->where('id_objek', $id_objek);
        $this->db->where('id_jenis_tiket', $id_jenis_tiket);
        if ($id_harga) {
            $this->db->where('id_harga !=', $id_harga);
        }
        $query = $this->db->get('tbl_harga_tiket');
        return $query->num_rows() > 0;
    }

    public function get_harga_by_id($id_harga)
    {
        $this->db->where('id_harga', $id_harga);
        $query = $this->db->get('tbl_harga_tiket');
        return $query->row_array();
    }

    public function update_harga($id_harga, $data)
    {
        $this->db->where('id_harga', $id_harga);
        return $this->db->update('tbl_harga_tiket', $data);
    }

    public function hapus_harga($id_harga)
    {
        $this->db->where('id_harga', $id_harga);
        return $this->db->delete('tbl_harga_tiket');
    }

    public function get_harga_by_objek_id($id_objek)
    {
        $this->db->select('tbl_harga_tiket.*, tbl_jenis_tiket.nama_tiket');
        $this->db->from('tbl_harga_tiket');
        $this->db->join('tbl_jenis_tiket', 'tbl_harga_tiket.id_jenis_tiket = tbl_jenis_tiket.id_jenis_tiket');
        $this->db->where('tbl_harga_tiket.id_objek', $id_objek);
        $this->db->order_by('tbl_jenis_tiket.nama_tiket', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}