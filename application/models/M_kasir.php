<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model {

    /**
     * Menyimpan seluruh data transaksi
     * Menggunakan Database Transaction
     */
    public function simpan_transaksi($data_transaksi, $data_detail, $data_tiket)
    {
        $this->load->model('M_harga_tiket');

        $this->db->trans_start();

        // Insert transaksi
        $this->db->insert('tbl_transaksi', $data_transaksi);
        $id_transaksi = $this->db->insert_id();

        if (!$id_transaksi) {
            log_message('error', 'Gagal insert transaksi: ' . print_r($this->db->error(), true));
            $this->db->trans_rollback();
            return false;
        }

        // Insert detail transaksi
        $detail_batch = [];
        foreach ($data_detail as $id_harga => $item) {
            $harga_info = $this->M_harga_tiket->get_harga_by_id($id_harga);

            if (!$harga_info) {
                log_message('error', 'Harga tidak ditemukan untuk id_harga: ' . $id_harga);
                $this->db->trans_rollback();
                return false;
            }

            $detail_batch[] = [
                'id_transaksi' => $id_transaksi,
                'id_jenis_tiket' => $harga_info['id_jenis_tiket'],
                'jumlah' => $item['jumlah'],
                'harga_saat_transaksi' => $item['harga_saat_transaksi']
            ];
        }
        
        if (!empty($detail_batch)) {
            $this->db->insert_batch('tbl_transaksi_detail', $detail_batch);
        }

        // Insert tiket
        $data_tiket['id_transaksi'] = $id_transaksi;
        $this->db->insert('tbl_tiket', $data_tiket);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Transaksi gagal: ' . print_r($this->db->error(), true));
            return false;
        } else {
            log_message('debug', 'Transaksi berhasil dengan ID: ' . $id_transaksi);
            return $id_transaksi;
        }
    }

    /**
     * Mengambil data untuk struk berdasarkan ID Transaksi
     */
    public function get_struk_by_id($id_transaksi)
    {
        // Ambil data utama transaksi
        $this->db->select('t.*, o.nama_objek, k.nama_kabupaten, u.nama_lengkap as nama_kasir');
        $this->db->from('tbl_transaksi t');
        $this->db->join('tbl_objek_wisata o', 't.id_objek = o.id_objek');
        $this->db->join('tbl_kabupaten k', 'o.id_kabupaten = k.id_kabupaten');
        $this->db->join('tbl_user u', 't.id_user_kasir = u.id_user');
        $this->db->where('t.id_transaksi', $id_transaksi);
        $data['transaksi'] = $this->db->get()->row_array();

        // Ambil data detail tiket
        $this->db->select('td.*, jt.nama_tiket');
        $this->db->from('tbl_transaksi_detail td');
        $this->db->join('tbl_jenis_tiket jt', 'td.id_jenis_tiket = jt.id_jenis_tiket');
        $this->db->where('td.id_transaksi', $id_transaksi);
        $data['detail'] = $this->db->get()->result_array();

        // Ambil kode QR
        $this->db->select('kode_tiket');
        $this->db->from('tbl_tiket');
        $this->db->where('id_transaksi', $id_transaksi);
        $data['tiket'] = $this->db->get()->row_array();

        return $data;
    }

    public function get_transaksi_by_id($id_transaksi)
    {
        $this->db->select('id_user_kasir, id_objek');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get()->row_array();
    }
}