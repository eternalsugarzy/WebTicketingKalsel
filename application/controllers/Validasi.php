<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();
        check_role(['Admin', 'Kasir', 'Petugas']);
        $this->load->model('M_validasi');
    }

    /**
     * Menampilkan halaman scanner
     */
    public function index()
    {
        $data['judul_halaman'] = 'Validasi Tiket (Scanner)';
        
        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('validasi/v_validasi_index', $data);
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Fungsi yang dipanggil oleh AJAX dari scanner
     */
    public function cek_kode()
    {
        // Ambil kode tiket dari request POST
        $kode_tiket = $this->input->post('kode_tiket');
        
        // Ambil ID petugas yang sedang login dari session
        $id_petugas = $this->session->userdata('id_user');

        // Panggil model untuk memvalidasi
        $hasil = $this->M_validasi->validasi_tiket($kode_tiket, $id_petugas);
        
        // Kembalikan hasil sebagai JSON
        header('Content-Type: application/json');
        echo json_encode($hasil);
    }

}