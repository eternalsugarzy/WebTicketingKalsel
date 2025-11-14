<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Cek status login
        if ( ! $this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
            redirect('auth');
        }

        $this->load->model('M_harga_tiket');
        // [BARU] Memuat model kasir
        $this->load->model('M_kasir'); 
    }

    /**
     * Halaman utama Kasir Penjualan
     */
    public function index()
    {
        $data['judul_halaman'] = 'Kasir Penjualan Tiket';
        $data['objek_wisata'] = $this->M_harga_tiket->get_objek_wisata_list();

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('kasir/v_kasir_index', $data);
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Dipanggil oleh AJAX
     * Mengambil daftar tiket berdasarkan ID Objek
     */
    public function get_tiket_by_objek()
    {
        $id_objek = $this->input->post('id_objek');
        $data['daftar_tiket'] = $this->M_harga_tiket->get_harga_by_objek_id($id_objek);
        $this->load->view('kasir/v_ajax_tiket_list', $data);
    }

    /**
     * [FUNGSI BARU] Dipanggil oleh AJAX
     * Memproses dan menyimpan transaksi
     */
    public function proses_transaksi()
    {
        // Set header output ke JSON
        header('Content-Type: application/json');

        // 1. Ambil data dari POST
        $id_objek = $this->input->post('id_objek');
        $items = $this->input->post('tiket');
        $total_harga = 0;

        // Validasi minimal 1 item
        if (empty($items) || empty($id_objek)) {
            echo json_encode(['status' => 'gagal', 'message' => 'Keranjang kosong atau Objek Wisata belum dipilih.']);
            return;
        }

        // 2. Siapkan data untuk batch insert
        $data_detail = [];
        foreach ($items as $id_harga => $item) {
            $jumlah = (int)$item['jumlah'];
            $harga = (int)$item['harga'];
            $subtotal = $jumlah * $harga;
            $total_harga += $subtotal;

            // Kumpulkan data untuk disimpan (key adalah id_harga)
            $data_detail[$id_harga] = [ 
                'jumlah' => $jumlah,
                'harga_saat_transaksi' => $harga
            ];
        }

        // 3. Siapkan data untuk tabel utama
        $data_transaksi = [
            'id_user_kasir' => $this->session->userdata('id_user'),
            'id_objek' => $id_objek,
            'waktu_transaksi' => date('Y-m-d H:i:s'),
            'total_harga' => $total_harga,
            'status_transaksi' => 'Lunas'
        ];

        // 4. Siapkan data untuk tabel tiket (QR Code)
        // Format: TKT-[TanggalYmd]-[UnixTimestamp]
        $kode_tiket = 'TKT-' . date('Ymd') . '-' . time();
        $data_tiket = [
            'id_transaksi' => 0, // Akan diisi oleh model
            'kode_tiket' => $kode_tiket,
            'status_tiket' => 'BELUM_DIPAKAI'
        ];

        // 5. Simpan ke database via model
        $id_transaksi = $this->M_kasir->simpan_transaksi($data_transaksi, $data_detail, $data_tiket);

        // 6. Kirim respon kembali ke JavaScript
        if ($id_transaksi) {
            echo json_encode([
                'status' => 'sukses',
                'id_transaksi' => $id_transaksi
            ]);
        } else {
            echo json_encode([
                'status' => 'gagal',
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ]);
        }
    }

    /**
     * [FUNGSI BARU] Halaman cetak struk
     * (Output #1)
     */
    public function cetak_struk($id_transaksi)
    {
        $data['judul_halaman'] = 'Cetak Struk';
        
        // Ambil semua data untuk struk
        $data['struk'] = $this->M_kasir->get_struk_by_id($id_transaksi);

        // Jika data transaksi tidak ditemukan, tampilkan 404
        if (empty($data['struk']['transaksi'])) {
            show_404();
        }
        
        // Memuat view struk
        $this->load->view('kasir/v_struk', $data);
    }
}