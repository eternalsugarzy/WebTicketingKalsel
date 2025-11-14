<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_harga_tiket extends CI_Model {

    // [PERUBAHAN 1] Menambahkan $filter_objek = null
    public function get_all_harga($filter_kategori = null, $search_query = null, $filter_objek = null)
    {
        $this->db->select('
            tbl_harga_tiket.*, 
            tbl_objek_wisata.nama_objek, 
            tbl_jenis_tiket.nama_tiket
        ');
        $this->db->from('tbl_harga_tiket');
        $this->db->join('tbl_objek_wisata', 'tbl_harga_tiket.id_objek = tbl_objek_wisata.id_objek');
        $this->db->join('tbl_jenis_tiket', 'tbl_harga_tiket.id_jenis_tiket = tbl_jenis_tiket.id_jenis_tiket');

        if ($filter_kategori) {
            $this->db->where('tbl_harga_tiket.id_jenis_tiket', $filter_kategori);
        }
        if ($search_query) {
            $this->db->like('tbl_objek_wisata.nama_objek', $search_query);
        }

        // [PERUBAHAN 2] Menambahkan blok IF baru untuk filter objek
        if ($filter_objek) {
            $this->db->where('tbl_harga_tiket.id_objek', $filter_objek);
        }

        $this->db->order_by('id_harga', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
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

    /**
     * [PERUBAHAN] Cek duplikat, bisa mengabaikan ID saat ini (untuk edit)
     */
    public function cek_duplikat($id_objek, $id_jenis_tiket, $id_harga = null)
    {
        $this->db->where('id_objek', $id_objek);
        $this->db->where('id_jenis_tiket', $id_jenis_tiket);
        
        // Jika $id_harga diisi, abaikan ID tersebut dari pengecekan
        if ($id_harga) {
            $this->db->where('id_harga !=', $id_harga);
        }
        
        $query = $this->db->get('tbl_harga_tiket');
        return $query->num_rows() > 0; // return true jika data duplikat ditemukan
    }

    /**
     * [FUNGSI BARU] Mengambil satu data harga berdasarkan ID
     */
    public function get_harga_by_id($id_harga)
    {
        $this->db->where('id_harga', $id_harga);
        $query = $this->db->get('tbl_harga_tiket');
        return $query->row_array(); // Kembalikan 1 baris data
    }

    /**
     * [FUNGSI BARU] Memperbarui data harga di database
     */
    public function update_harga($id_harga, $data)
    {
        $this->db->where('id_harga', $id_harga);
        return $this->db->update('tbl_harga_tiket', $data);
    }

    /**
     * [FUNGSI BARU] Menghapus data harga berdasarkan ID
     */
    public function hapus_harga($id_harga)
    {
        $this->db->where('id_harga', $id_harga);
        return $this->db->delete('tbl_harga_tiket');
    }

    /**
     * [FUNGSI BARU] Mengambil semua harga tiket untuk 1 objek wisata
     * (Untuk halaman kasir AJAX)
     */
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