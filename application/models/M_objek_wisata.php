<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_objek_wisata extends CI_Model {

    // [MODIFIKASI] Menambahkan parameter $limit dan $start
    public function get_all_objek($filter_kabupaten = null, $search_query = null, $limit = null, $start = null)
    {
        $this->db->select('tbl_objek_wisata.*, tbl_kabupaten.nama_kabupaten');
        $this->db->from('tbl_objek_wisata');
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten');

        // Panggil filter helper
        $this->_apply_filters($filter_kabupaten, $search_query);
        
        $this->db->order_by('id_objek', 'DESC');

        // [BARU] Limit Data untuk Pagination
        if ($limit) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

    // [FUNGSI BARU] Menghitung Total Data (Penting untuk Pagination)
    public function count_all_objek($filter_kabupaten = null, $search_query = null)
    {
        $this->db->from('tbl_objek_wisata');
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten');
        
        // Panggil filter helper yang sama
        $this->_apply_filters($filter_kabupaten, $search_query);

        return $this->db->count_all_results();
    }

    // [HELPER PRIVATE] Agar logic filter tidak ditulis ulang 2 kali
    private function _apply_filters($filter_kabupaten, $search_query) {
        if ($filter_kabupaten) {
            $this->db->where('tbl_objek_wisata.id_kabupaten', $filter_kabupaten);
        }
        if ($search_query) {
            $this->db->like('tbl_objek_wisata.nama_objek', $search_query);
        }
    }

    // --- FUNGSI DI BAWAH INI TETAP SAMA ---

    public function get_all_kabupaten()
    {
        $this->db->order_by('nama_kabupaten', 'ASC');
        $query = $this->db->get('tbl_kabupaten');
        return $query->result_array();
    }

    public function tambah_objek($data)
    {
        return $this->db->insert('tbl_objek_wisata', $data);
    }

    public function get_objek_by_id($id_objek)
    {
        $this->db->select('tbl_objek_wisata.*, tbl_kabupaten.nama_kabupaten');
        $this->db->from('tbl_objek_wisata');
        $this->db->join('tbl_kabupaten', 'tbl_objek_wisata.id_kabupaten = tbl_kabupaten.id_kabupaten', 'left');
        $this->db->where('tbl_objek_wisata.id_objek', $id_objek);
        $query = $this->db->get();
        return $query->row_array(); 
    }

    public function update_objek($id_objek, $data)
    {
        $this->db->where('id_objek', $id_objek);
        return $this->db->update('tbl_objek_wisata', $data);
    }

    public function hapus_objek($id_objek)
    {
        $this->db->where('id_objek', $id_objek);
        return $this->db->delete('tbl_objek_wisata');
    }

    public function get_kabupaten_by_id($id_kabupaten)
    {
        $this->db->where('id_kabupaten', $id_kabupaten);
        $query = $this->db->get('tbl_kabupaten');
        return $query->row_array();
    }

    public function can_delete($id_objek)
    {
        $this->db->from('tbl_transaksi');
        $this->db->where('id_objek', $id_objek);
        return $this->db->count_all_results() === 0;
    }
}