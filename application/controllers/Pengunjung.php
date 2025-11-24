<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ( ! $this->session->userdata('username')) {
            redirect('auth');
        }
        $this->load->model('M_pengunjung');
    }

    public function index()
    {
        $data['judul_halaman'] = 'Data Pengunjung';
        
        // 1. Ambil Input Filter dari URL (GET request)
        $tgl_awal     = $this->input->get('tgl_awal');
        $tgl_akhir    = $this->input->get('tgl_akhir');
        $id_objek     = $this->input->get('id_objek');
        $id_kabupaten = $this->input->get('id_kabupaten');

        // 2. Siapkan Data untuk Dropdown Filter
        // (Asumsi nama tabel Anda tbl_objek_wisata dan tbl_kabupaten)
        $data['opt_objek']     = $this->db->get('tbl_objek_wisata')->result();
        $data['opt_kabupaten'] = $this->db->get('tbl_kabupaten')->result();

        // 3. Simpan filter saat ini agar form tidak reset setelah submit
        $data['f_tgl_awal']     = $tgl_awal;
        $data['f_tgl_akhir']    = $tgl_akhir;
        $data['f_id_objek']     = $id_objek;
        $data['f_id_kabupaten'] = $id_kabupaten;

        // 4. Panggil Model dengan Parameter Filter
        $data['pengunjung'] = $this->M_pengunjung->get_all_pengunjung($tgl_awal, $tgl_akhir, $id_objek, $id_kabupaten);

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('pengunjung/v_pengunjung_index', $data);
        $this->load->view('template/v_footer', $data);
    }
}