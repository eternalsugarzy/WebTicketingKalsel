<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_tiket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
            redirect('auth');
        }
        $this->load->model('M_harga_tiket');
    }

    public function index()
    {
        $filter_kategori = $this->input->get('filter_kategori');
        $search_query = $this->input->get('search_query');
        // [TAMBAHAN] Ambil filter objek wisata
        $filter_objek = $this->input->get('filter_objek');

        $data['judul_halaman'] = 'Manajemen Harga Tiket';

        // [TAMBAHAN] Kirim semua 3 parameter ke Model
        $data['daftar_harga'] = $this->M_harga_tiket->get_all_harga($filter_kategori, $search_query, $filter_objek);

        // Ambil data untuk dropdown filter
        $data['kategori_list'] = $this->M_harga_tiket->get_jenis_tiket_list();
        // [TAMBAHAN] Ambil data objek wisata untuk dropdown filter
        $data['objek_list'] = $this->M_harga_tiket->get_objek_wisata_list();

        // Kirim nilai filter saat ini kembali ke View
        $data['selected_kategori'] = $filter_kategori;
        // [TAMBAHAN]
        $data['selected_objek'] = $filter_objek;
        $data['current_search'] = $search_query;

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('harga_tiket/v_harga_index', $data);
        $this->load->view('template/v_footer', $data);
    }

    public function tambah()
    {
        $data['judul_halaman'] = 'Atur Harga Tiket Baru';
        $data['objek_wisata'] = $this->M_harga_tiket->get_objek_wisata_list();
        $data['jenis_tiket'] = $this->M_harga_tiket->get_jenis_tiket_list();

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('harga_tiket/v_harga_tambah', $data);
        $this->load->view('template/v_footer', $data);
    }

    public function proses_tambah()
    {
        $this->form_validation->set_rules('id_objek', 'Objek Wisata', 'trim|required');
        $this->form_validation->set_rules('id_jenis_tiket', 'Kategori Tiket', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $id_objek = $this->input->post('id_objek');
            $id_jenis_tiket = $this->input->post('id_jenis_tiket');

            if ($this->M_harga_tiket->cek_duplikat($id_objek, $id_jenis_tiket)) {
                $this->session->set_flashdata('error', 'Harga untuk kombinasi objek wisata dan kategori tiket tersebut sudah ada!');
                $this->tambah();
            } else {
                $data = [
                    'id_objek' => $id_objek,
                    'id_jenis_tiket' => $id_jenis_tiket,
                    'harga' => $this->input->post('harga')
                ];
                $this->M_harga_tiket->tambah_harga($data);
                $this->session->set_flashdata('sukses', 'Harga tiket baru berhasil diatur.');
                redirect('harga_tiket');
            }
        }
    }

   /**
     * [FUNGSI UPDATE] Halaman form edit
     */
    public function edit($id_harga)
    {
        $data['judul_halaman'] = 'Edit Harga Tiket';
        
        // Ambil data harga lama
        $data['harga'] = $this->M_harga_tiket->get_harga_by_id($id_harga);
        // Ambil data untuk dropdown
        $data['objek_wisata'] = $this->M_harga_tiket->get_objek_wisata_list();
        
        // [PERBAIKAN] Hapus spasi yang salah di sini ('jenis_ tiket' -> 'jenis_tiket')
        $data['jenis_tiket'] = $this->M_harga_tiket->get_jenis_tiket_list();

        if ( ! $data['harga']) {
            redirect('harga_tiket');
        }

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        // Pastikan nama file view Anda benar, di sini saya gunakan nama dari chat Anda sebelumnya
        $this->load->view('harga_tiket/v_harga_edit', $data); 
        $this->load->view('template/v_footer', $data);
    }

    /**
     * [FUNGSI BARU] Proses edit data
     */
    public function proses_edit($id_harga)
    {
        // Aturan validasi
        $this->form_validation->set_rules('id_objek', 'Objek Wisata', 'trim|required');
        $this->form_validation->set_rules('id_jenis_tiket', 'Kategori Tiket', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_harga);
        } else {
            $id_objek = $this->input->post('id_objek');
            $id_jenis_tiket = $this->input->post('id_jenis_tiket');

            // Cek duplikat, tapi abaikan ID harga saat ini
            if ($this->M_harga_tiket->cek_duplikat($id_objek, $id_jenis_tiket, $id_harga)) {
                $this->session->set_flashdata('error', 'Kombinasi objek dan kategori tiket tersebut sudah digunakan oleh data harga lain.');
                $this->edit($id_harga);
            } else {
                // Siapkan data update
                $data = [
                    'id_objek' => $id_objek,
                    'id_jenis_tiket' => $id_jenis_tiket,
                    'harga' => $this->input->post('harga')
                ];
                
                $this->M_harga_tiket->update_harga($id_harga, $data);
                $this->session->set_flashdata('sukses', 'Data harga tiket berhasil diperbarui.');
                redirect('harga_tiket');
            }
        }
    }
    /**
     * [FUNGSI BARU] Proses hapus data
     */
    public function hapus($id_harga)
    {
        // 1. Panggil model untuk hapus data
        $this->M_harga_tiket->hapus_harga($id_harga);

        // 2. Set pesan sukses dan redirect
        $this->session->set_flashdata('sukses', 'Data harga tiket berhasil dihapus.');
        redirect('harga_tiket');
    }

}