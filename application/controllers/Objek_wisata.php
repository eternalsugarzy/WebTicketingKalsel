<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objek_wisata extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
            redirect('auth');
        }
        $this->load->model('M_objek_wisata');
    }

    /**
     * [PERUBAHAN] Halaman daftar sekarang menangani filter & pencarian
     */
    public function index()
    {
        // [BARU] Ambil data filter & pencarian dari URL (via method GET)
        $filter_kabupaten = $this->input->get('filter_kabupaten');
        $search_query = $this->input->get('search_query');

        $data['judul_halaman'] = 'Manajemen Objek Wisata';

        // [BARU] Kirim data filter & pencarian ke Model
        $data['objek_wisata'] = $this->M_objek_wisata->get_all_objek($filter_kabupaten, $search_query);

        // [BARU] Ambil data kabupaten untuk dropdown filter
        $data['kabupaten_list'] = $this->M_objek_wisata->get_all_kabupaten();

        // [BARU] Kirim nilai filter & pencarian saat ini kembali ke View
        $data['selected_kabupaten'] = $filter_kabupaten;
        $data['current_search'] = $search_query;

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('objek_wisata/v_objek_index', $data);
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Halaman form tambah
     */
    public function tambah()
    {
        $data['judul_halaman'] = 'Tambah Objek Wisata';
        // Mengganti nama variabel agar konsisten (get_all_kabupaten)
        $data['kabupaten'] = $this->M_objek_wisata->get_all_kabupaten(); 

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('objek_wisata/v_objek_tambah', $data);
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Proses tambah data
     */
    public function proses_tambah()
    {
        $this->form_validation->set_rules('nama_objek', 'Nama Objek Wisata', 'trim|required');
        $this->form_validation->set_rules('id_kabupaten', 'Kabupaten/Kota', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'nama_objek' => $this->input->post('nama_objek'),
                'id_kabupaten' => $this->input->post('id_kabupaten'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->M_objek_wisata->tambah_objek($data);
            $this->session->set_flashdata('sukses', 'Data objek wisata berhasil ditambahkan.');
            redirect('objek_wisata');
        }
    }

    /**
     * Halaman form edit
     */
    public function edit($id_objek)
    {
        $data['judul_halaman'] = 'Edit Objek Wisata';
        $data['objek'] = $this->M_objek_wisata->get_objek_by_id($id_objek);
        // Mengganti nama variabel agar konsisten
        $data['kabupaten'] = $this->M_objek_wisata->get_all_kabupaten(); 

        if ( ! $data['objek']) {
            redirect('objek_wisata');
        }

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('objek_wisata/v_objek_edit', $data);
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Proses edit data
     */
    public function proses_edit($id_objek)
    {
        $this->form_validation->set_rules('nama_objek', 'Nama Objek Wisata', 'trim|required');
        $this->form_validation->set_rules('id_kabupaten', 'Kabupaten/Kota', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_objek);
        } else {
            $data = [
                'nama_objek' => $this->input->post('nama_objek'),
                'id_kabupaten' => $this->input->post('id_kabupaten'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->M_objek_wisata->update_objek($id_objek, $data);
            $this->session->set_flashdata('sukses', 'Data objek wisata berhasil diperbarui.');
            redirect('objek_wisata');
        }
    }

    /**
     * Proses hapus data
     */
    public function hapus($id_objek)
    {
        $this->M_objek_wisata->hapus_objek($id_objek);
        $this->session->set_flashdata('sukses', 'Data objek wisata berhasil dihapus.');
        redirect('objek_wisata');
    }
}