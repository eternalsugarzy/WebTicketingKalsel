<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // [PERBAIKAN] Mengganti $this. menjadi $this->
        if ( ! $this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
            redirect('auth');
        }

        // [PERBAIKAN] Mengganti $this. menjadi $this->
        $this->load->model('M_validasi');
    }

    /**
     * Halaman utama (Scanner QR)
     */
    public function index()
    {
        // Data untuk template
        $data['judul_halaman'] = 'Validasi Tiket (Scanner)';

        // [PERBAIKAN] Mengganti $this. menjadi $this->
        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('validasi/v_validasi_index', $data); 
        $this->load->view('template/v_footer', $data);
    }

    /**
     * [FUNGSI BARU] Dipanggil oleh AJAX dari scanner
     * Mengecek kode tiket dan memvalidasinya
     */
    public function cek_kode()
    {
        // Set header output ke JSON
        header('Content-Type: application/json');

        // [PERBAIKAN] Mengganti $this. menjadi $this->
        $kode_tiket = $this->input->post('kode_tiket');
        $id_petugas = $this->session->userdata('id_user');

        if (empty($kode_tiket)) {
            echo json_encode(['status' => 'error', 'message' => 'Kode tiket tidak boleh kosong.']);
            return;
        }

        // Panggil model untuk memvalidasi
        // [PERBAIKAN] Mengganti $this. menjadi $this->
        $hasil = $this->M_validasi->validasi_tiket($kode_tiket, $id_petugas);

        // Kirim balasan
        echo json_encode($hasil);
    }
}