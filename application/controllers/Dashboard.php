<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Cek status login
        if ( ! $this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
            redirect('auth');
        }

        // MEMUAT MODEL: Memanggil file M_dashboard.php
        $this->load->model('M_dashboard');
        // [TAMBAHAN] Memuat model Laporan untuk mengambil data total
        $this->load->model('M_laporan'); 
    }

    public function index()
    {
        // --- 1. PROSES PENGAMBILAN DATA GRAFIK ---
        
        // Panggil fungsi get_pengunjung_per_kabupaten dari Model
        $grafik_data = $this->M_dashboard->get_pengunjung_per_kabupaten();

        // Siapkan array kosong untuk menampung data
        $labels = [];
        $data_values = [];

        // Looping data hasil query
        foreach ($grafik_data as $row) {
            $labels[] = $row['nama_kabupaten'];    // Memasukkan nama kabupaten ke array labels
            $data_values[] = (int) $row['total_pengunjung']; // Memasukkan total ke array data_values
        }

        // --- 2. [TAMBAHAN] PROSES DATA KOTAK STATISTIK ---
        $tanggal_hari_ini = date('Y-m-d');
        // Panggil fungsi dari M_laporan untuk tanggal hari ini
        $data['total_hari_ini'] = $this->M_laporan->get_total_penjualan($tanggal_hari_ini, $tanggal_hari_ini);

        // --- 3. MENGIRIM DATA KE VIEW ---
        
        // Data utama untuk template
        $data['judul_halaman'] = 'Dashboard';

        // Mengubah array PHP menjadi format JSON agar bisa dibaca JavaScript
        $data['grafik_labels_json'] = json_encode($labels);
        $data['grafik_data_json'] = json_encode($data_values);
        // Data $total_hari_ini otomatis terkirim

        // --- 4. MEMUAT TAMPILAN (VIEW) ---
        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('v_dashboard', $data); // Ini adalah konten utamanya
        $this->load->view('template/v_footer', $data);
    }
}