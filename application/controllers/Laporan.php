<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();
        check_role('Admin');
        $this->load->model('M_laporan');
    }

    /**
     * Halaman utama (Laporan Penjualan HTML)
     */
    public function penjualan()
    {
        $tgl_mulai = $this->input->get('tgl_mulai');
        $tgl_selesai = $this->input->get('tgl_selesai');

        if (empty($tgl_mulai) || empty($tgl_selesai)) {
            $tgl_mulai = date('Y-m-d'); 
            $tgl_selesai = date('Y-m-d');
        }

        $data['laporan_penjualan'] = $this->M_laporan->get_laporan_penjualan($tgl_mulai, $tgl_selesai);
        $data['total'] = $this->M_laporan->get_total_penjualan($tgl_mulai, $tgl_selesai);
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;
        $data['judul_halaman'] = 'Laporan Penjualan';

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('laporan/v_laporan_penjualan', $data); 
        $this->load->view('template/v_footer', $data);
    }

    /**
     * [FUNGSI BARU] Membuat Laporan PDF dengan Dompdf
     */
    public function cetak_pdf()
    {
        // 1. Memuat library Pdfgenerator
        $this->load->library('pdfgenerator');

        // 2. Mengambil data tanggal dari URL (sama seperti fungsi index)
        $tgl_mulai = $this->input->get('tgl_mulai');
        $tgl_selesai = $this->input->get('tgl_selesai');

        if (empty($tgl_mulai) || empty($tgl_selesai)) {
            $tgl_mulai = date('Y-m-d');
            $tgl_selesai = date('Y-m-d');
        }
        
        // 3. Menyiapkan data untuk dikirim ke view PDF
        $data['laporan_penjualan'] = $this->M_laporan->get_laporan_penjualan($tgl_mulai, $tgl_selesai);
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;

        // 4. Memuat view HTML (v_laporan_cetak_a4) sebagai string
        //    Parameter 'TRUE' adalah kunci untuk ini
        $html = $this->load->view('laporan/v_laporan_cetak_a4', $data, TRUE);
        
        // 5. Membuat nama file
        $filename = 'Laporan_Penjualan_' . $tgl_mulai . '_sd_' . $tgl_selesai;
        
        // 6. Generate PDF
        //    (true = tampilkan di browser, A4, portrait)
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    /**
     * [FUNGSI BARU] Halaman web untuk Laporan Ringkas
     */
    public function penjualan_ringkas()
    {
        // Data untuk template
        $data['judul_halaman'] = 'Laporan Penjualan Ringkas';

        // Ambil tanggal dari URL, default-nya hari ini
        $tanggal = $this->input->get('tanggal');
        if (empty($tanggal)) {
            $tanggal = date('Y-m-d'); // Tanggal hari ini
        }

        // Ambil data ringkasan dari model
        $data['laporan_ringkas'] = $this->M_laporan->get_laporan_ringkas($tanggal);
        // Ambil data total
        $data['total'] = $this->M_laporan->get_total_penjualan($tanggal, $tanggal);
        
        // Kirim tanggal kembali ke view
        $data['tanggal'] = $tanggal;

        // Memuat view dengan template
        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('laporan/v_laporan_ringkas_index', $data); // View baru
        $this->load->view('template/v_footer', $data);
    }

    /**
     * [FUNGSI BARU] Membuat Laporan PDF Ringkas (via Dompdf)
     */
    public function cetak_pdf_ringkas()
    {
        // 1. Memuat library Pdfgenerator
        $this->load->library('pdfgenerator');

        // 2. Mengambil data tanggal dari URL
        $tanggal = $this->input->get('tanggal');
        if (empty($tanggal)) {
            $tanggal = date('Y-m-d');
        }
        
        // 3. Menyiapkan data untuk dikirim ke view PDF
        $data['laporan_ringkas'] = $this->M_laporan->get_laporan_ringkas($tanggal);
        $data['total'] = $this->M_laporan->get_total_penjualan($tanggal, $tanggal);
        $data['tanggal'] = $tanggal;
        
        // 4. Memuat view HTML (v_laporan_ringkas_cetak_a4) sebagai string
        $html = $this->load->view('laporan/v_laporan_ringkas_cetak_a4', $data, TRUE);
        
        // 5. Membuat nama file
        $filename = 'Laporan_Ringkas_' . $tanggal;
        
        // 6. Generate PDF
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    /**
     * [FUNGSI BARU] Halaman Laporan Kunjungan (Absensi Scan)
     */
    public function kunjungan()
    {
        // Data untuk template
        $data['judul_halaman'] = 'Laporan Kunjungan (Hasil Scan)';

        // Ambil data filter tanggal dari URL (method GET)
        $tgl_mulai = $this->input->get('tgl_mulai');
        $tgl_selesai = $this->input->get('tgl_selesai');

        // Jika tidak ada filter, set default hari ini
        if (empty($tgl_mulai) || empty($tgl_selesai)) {
            $tgl_mulai = date('Y-m-d'); // Tanggal hari ini
            $tgl_selesai = date('Y-m-d'); // Tanggal hari ini
        }

        // Mengambil data laporan dari model
        $data['laporan_kunjungan'] = $this->M_laporan->get_laporan_kunjungan($tgl_mulai, $tgl_selesai);
        
        // Kirim tanggal filter kembali ke view
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;

        // Memuat view dengan template
        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('laporan/v_laporan_kunjungan', $data); // View baru
        $this->load->view('template/v_footer', $data);
    }

    /**
     * [FUNGSI BARU] Membuat Laporan PDF Kunjungan
     */
    public function cetak_pdf_kunjungan()
    {
        // 1. Memuat library Pdfgenerator
        $this->load->library('pdfgenerator');

        // 2. Mengambil data tanggal dari URL
        $tgl_mulai = $this->input->get('tgl_mulai');
        $tgl_selesai = $this->input->get('tgl_selesai');

        if (empty($tgl_mulai) || empty($tgl_selesai)) {
            $tgl_mulai = date('Y-m-d');
            $tgl_selesai = date('Y-m-d');
        }
        
        // 3. Menyiapkan data untuk dikirim ke view PDF
        $data['laporan_kunjungan'] = $this->M_laporan->get_laporan_kunjungan($tgl_mulai, $tgl_selesai);
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;

        // 4. Memuat view HTML (v_laporan_kunjungan_cetak_a4) sebagai string
        $html = $this->load->view('laporan/v_laporan_kunjungan_cetak_a4', $data, TRUE);
        
        // 5. Membuat nama file
        $filename = 'Laporan_Kunjungan_' . $tgl_mulai . '_sd_' . $tgl_selesai;
        
        // 6. Generate PDF
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    /**
     * [FUNGSI BARU] Halaman Laporan Rekapitulasi per Objek Wisata
     */
    public function rekap_objek()
    {
        $data['judul_halaman'] = 'Laporan Rekapitulasi per Objek Wisata';

        // Ambil data filter
        $tgl_mulai = $this->input->get('tgl_mulai');
        $tgl_selesai = $this->input->get('tgl_selesai');
        $id_kabupaten = $this->input->get('id_kabupaten');

        // Set default tanggal hari ini jika kosong
        if (empty($tgl_mulai) || empty($tgl_selesai)) {
            $tgl_mulai = date('Y-m-d');
            $tgl_selesai = date('Y-m-d');
        }

        // Mengambil data laporan dari model
        $data['laporan_rekap'] = $this->M_laporan->get_rekap_objek($tgl_mulai, $tgl_selesai, $id_kabupaten);
        
        // Mengambil daftar kabupaten untuk dropdown filter
        // Kita butuh model M_objek_wisata untuk ini
        $this->load->model('M_objek_wisata');
        $data['kabupaten_list'] = $this->M_objek_wisata->get_all_kabupaten();

        // Kirim tanggal filter kembali ke view
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;
        $data['selected_kabupaten'] = $id_kabupaten;

        // Memuat view dengan template
        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('laporan/v_laporan_rekap_objek', $data); // View baru
        $this->load->view('template/v_footer', $data);
    }

    /**
     * [FUNGSI BARU] Membuat Laporan PDF Rekapitulasi per Objek
     */
    public function cetak_pdf_rekap_objek()
    {
        $this->load->library('pdfgenerator');

        // Ambil data filter
        $tgl_mulai = $this->input->get('tgl_mulai');
        $tgl_selesai = $this->input->get('tgl_selesai');
        $id_kabupaten = $this->input->get('id_kabupaten');

        if (empty($tgl_mulai) || empty($tgl_selesai)) {
            $tgl_mulai = date('Y-m-d');
            $tgl_selesai = date('Y-m-d');
        }
        
        // Menyiapkan data untuk dikirim ke view PDF
        $data['laporan_rekap'] = $this->M_laporan->get_rekap_objek($tgl_mulai, $tgl_selesai, $id_kabupaten);
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;

        // [BARU] Dapatkan nama kabupaten untuk judul PDF
        if (!empty($id_kabupaten)) {
            // Kita perlu memuat model Objek_wisata untuk mengambil nama kabupaten
            $this->load->model('M_objek_wisata'); 
            $kab = $this->M_objek_wisata->get_kabupaten_by_id($id_kabupaten); // (Kita harus buat fungsi ini)
            $data['nama_kabupaten'] = $kab['nama_kabupaten'];
        } else {
            $data['nama_kabupaten'] = 'Semua Kabupaten/Kota';
        }
        
        $html = $this->load->view('laporan/v_laporan_rekap_cetak_a4', $data, TRUE);
        $filename = 'Laporan_Rekapitulasi_Objek_' . $tgl_mulai . '_sd_' . $tgl_selesai;
        
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    /**
     * [FUNGSI BARU] Halaman untuk Laporan Data Master
     */
    public function data_master()
    {
        $data['judul_halaman'] = 'Cetak Laporan Data Master';

        // Memuat view dengan template
        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('laporan/v_laporan_master_index', $data); // View baru
        $this->load->view('template/v_footer', $data);
    }

    /**
     * [FUNGSI BARU] Membuat Laporan PDF Master Objek Wisata
     */
    public function cetak_pdf_master_objek()
    {
        $this->load->library('pdfgenerator');

        // [BARU] Kita perlu data dari M_objek_wisata
        $this->load->model('M_objek_wisata');
        $data['objek_wisata'] = $this->M_objek_wisata->get_all_objek(); // (Tanpa filter)
        
        $html = $this->load->view('laporan/v_laporan_master_objek_a4', $data, TRUE);
        $filename = 'Laporan_Data_Master_Objek_Wisata';
        
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    /**
     * [FUNGSI BARU] Membuat Laporan PDF Master Harga Tiket
     */
    public function cetak_pdf_master_harga()
    {
        $this->load->library('pdfgenerator');

        // [BARU] Kita perlu data dari M_harga_tiket
        $this->load->model('M_harga_tiket');
        // Panggil fungsi get_all_harga (tanpa filter)
        $data['daftar_harga'] = $this->M_harga_tiket->get_all_harga(); 
        
        $html = $this->load->view('laporan/v_laporan_master_harga_a4', $data, TRUE);
        $filename = 'Laporan_Data_Master_Harga_Tiket';
        
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    public function cetak_pdf_master_user()
{
    $this->load->library('pdfgenerator');

    $this->load->model('M_user');
    $data['daftar_user'] = $this->M_user->get_all_users(); 

    $html = $this->load->view('laporan/v_laporan_master_user_a4', $data, TRUE);
    $filename = 'Laporan_Data_Master_Pengguna';

    $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
}
    // (Nanti kita akan tambahkan fungsi cetak PDF-nya di sini)
}