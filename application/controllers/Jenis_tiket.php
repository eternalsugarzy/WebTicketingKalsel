<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_tiket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
            redirect('auth');
        }
        $this->load->model('M_jenis_tiket');
    }

    /**
     * Halaman daftar
     */
    public function index()
    {
        $data['judul_halaman'] = 'Manajemen Jenis Tiket';
        $data['jenis_tiket'] = $this->M_jenis_tiket->get_all_tiket();

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('jenis_tiket/v_tiket_index', $data);
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Halaman form tambah
     */
    public function tambah()
    {
        $data['judul_halaman'] = 'Tambah Kategori Tiket';

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('jenis_tiket/v_tiket_tambah', $data);
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Proses tambah data
     */
    public function proses_tambah()
    {
        $this->form_validation->set_rules('nama_tiket', 'Nama Kategori Tiket', 'trim|required|is_unique[tbl_jenis_tiket.nama_tiket]');
        $this->form_validation->set_message('is_unique', '%s ini sudah terdaftar.');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'nama_tiket' => $this->input->post('nama_tiket')
            ];
            $this->M_jenis_tiket->tambah_tiket($data);
            $this->session->set_flashdata('sukses', 'Kategori tiket baru berhasil ditambahkan.');
            redirect('jenis_tiket');
        }
    }

    /**
     * [FUNGSI BARU] Halaman form edit
     */
    public function edit($id_tiket)
    {
        $data['judul_halaman'] = 'Edit Kategori Tiket';
        
        // Ambil data tiket lama
        $data['tiket'] = $this->M_jenis_tiket->get_tiket_by_id($id_tiket);

        if ( ! $data['tiket']) {
            redirect('jenis_tiket');
        }

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('jenis_tiket/v_tiket_edit', $data);
        $this->load->view('template/v_footer', $data);
    }

    /**
     * [FUNGSI BARU] Proses edit data
     */
    public function proses_edit($id_tiket)
    {
        // 1. Ambil data lama (untuk cek nama unik)
        $tiket_lama = $this->M_jenis_tiket->get_tiket_by_id($id_tiket);

        // 2. Aturan validasi
        // Cek apakah nama tiket diubah. Jika ya, terapkan aturan is_unique.
        if ($this->input->post('nama_tiket') != $tiket_lama['nama_tiket']) {
            $this->form_validation->set_rules('nama_tiket', 'Nama Kategori Tiket', 'trim|required|is_unique[tbl_jenis_tiket.nama_tiket]');
            $this->form_validation->set_message('is_unique', '%s ini sudah terdaftar.');
        } else {
            $this->form_validation->set_rules('nama_tiket', 'Nama Kategori Tiket', 'trim|required');
        }

        // 3. Jalankan validasi
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_tiket);
        } else {
            // Siapkan data update
            $data = [
                'nama_tiket' => $this->input->post('nama_tiket')
            ];

            // Kirim ke model
            $this->M_jenis_tiket->update_tiket($id_tiket, $data);

            // Set pesan sukses dan redirect
            $this->session->set_flashdata('sukses', 'Kategori tiket berhasil diperbarui.');
            redirect('jenis_tiket');
        }

        
    }

    /**
     * [FUNGSI BARU] Proses hapus data
     */
    public function hapus($id_tiket)
    {
        // 1. Panggil model untuk hapus data
        $this->M_jenis_tiket->hapus_tiket($id_tiket);

        // 2. Set pesan sukses dan redirect
        $this->session->set_flashdata('sukses', 'Kategori tiket berhasil dihapus.');
        redirect('jenis_tiket');
    }

}