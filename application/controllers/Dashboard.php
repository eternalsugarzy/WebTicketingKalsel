<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();

        $this->load->model('M_dashboard');
        $this->load->model('M_laporan');
    }

    public function index()
    {
        // --- 1. DATA GRAFIK (Batang) ---
        $grafik_data = $this->M_dashboard->get_pengunjung_per_kabupaten();
        $labels = [];
        $data_values = [];

        foreach ($grafik_data as $row) {
            $labels[] = $row['nama_kabupaten'];
            $data_values[] = (int) $row['total_pengunjung'];
        }

        // --- 2. DATA KOTAK STATISTIK (Total Hari Ini) ---
        $tanggal_hari_ini = date('Y-m-d');
        $data['total_hari_ini'] = $this->M_laporan->get_total_penjualan($tanggal_hari_ini, $tanggal_hari_ini);

        // --- 3. DATA TOP 5 OBJEK WISATA ---
        $this->db->select('tbl_objek_wisata.nama_objek, SUM(tbl_transaksi_detail.jumlah) as total');
        $this->db->from('tbl_transaksi_detail');
        $this->db->join('tbl_transaksi', 'tbl_transaksi_detail.id_transaksi = tbl_transaksi.id_transaksi');
        $this->db->join('tbl_objek_wisata', 'tbl_transaksi.id_objek = tbl_objek_wisata.id_objek');
        $this->db->group_by('tbl_objek_wisata.id_objek');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(5); 
        $data['top_objek'] = $this->db->get()->result();

        // --- 4. DATA PENGUNJUNG TERBARU (Recent) ---
        $this->db->select('tbl_transaksi.*, tbl_objek_wisata.nama_objek, SUM(tbl_transaksi_detail.jumlah) as jumlah_orang');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_objek_wisata', 'tbl_transaksi.id_objek = tbl_objek_wisata.id_objek');
        $this->db->join('tbl_transaksi_detail', 'tbl_transaksi.id_transaksi = tbl_transaksi_detail.id_transaksi');
        $this->db->group_by('tbl_transaksi.id_transaksi');
        $this->db->order_by('tbl_transaksi.waktu_transaksi', 'DESC'); 
        $this->db->limit(5); 
        $data['pengunjung_terbaru'] = $this->db->get()->result();


        // --- 5. KIRIM DATA KE VIEW ---
        $data['judul_halaman'] = 'Dashboard';
        $data['grafik_labels_json'] = json_encode($labels);
        $data['grafik_data_json'] = json_encode($data_values);

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('v_dashboard', $data); 
        $this->load->view('template/v_footer', $data);
    }

    // FUNGSI UNTUK AJAX (Hanya ada satu sekarang)
    public function update_grafik()
    {
        // Pastikan respon dianggap sebagai JSON
        header('Content-Type: application/json');

        $filter = $this->input->post('filter'); 
        
        // Ambil data dari model
        $grafik_data = $this->M_dashboard->get_pengunjung_per_kabupaten($filter);

        $labels = [];
        $data_values = [];

        foreach ($grafik_data as $row) {
            $labels[] = $row['nama_kabupaten'];
            $data_values[] = (int) $row['total_pengunjung'];
        }

        // Kembalikan data beserta Token CSRF Baru
        echo json_encode([
            'status' => empty($data_values) ? 'empty' : 'success',
            'labels' => $labels,
            'values' => $data_values,
            'csrf_token' => $this->security->get_csrf_hash() // PENTING: Token baru
        ]);
    }
}