<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();
        check_role(['Admin', 'Kasir']);

        $this->load->model('M_harga_tiket');
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
        try {
            header('Content-Type: application/json');
            
            // Log untuk debugging
            log_message('debug', 'POST data: ' . print_r($_POST, true));

            $id_objek = $this->input->post('id_objek');
            $items = $this->input->post('tiket');
            $total_harga = 0;

            if (empty($items) || empty($id_objek)) {
                echo json_encode(['status' => 'gagal', 'message' => 'Keranjang kosong atau Objek Wisata belum dipilih.']);
                return;
            }

            $this->load->model('M_harga_tiket');

            $data_detail = [];
            foreach ($items as $id_harga => $item) {
                $jumlah = (int)$item['jumlah'];
                $id_harga = (int)$id_harga;

                if ($jumlah <= 0) {
                    continue;
                }

                $harga_info = $this->M_harga_tiket->get_harga_with_objek($id_harga, $id_objek);

                if (!$harga_info) {
                    echo json_encode(['status' => 'gagal', 'message' => 'Harga tiket tidak valid untuk objek wisata yang dipilih.']);
                    return;
                }

                $harga = (int)$harga_info['harga'];
                $subtotal = $jumlah * $harga;
                $total_harga += $subtotal;

                $data_detail[$id_harga] = [
                    'jumlah' => $jumlah,
                    'harga_saat_transaksi' => $harga
                ];
            }

            if (empty($data_detail)) {
                echo json_encode(['status' => 'gagal', 'message' => 'Tidak ada item tiket yang valid untuk diproses.']);
                return;
            }

            $data_transaksi = [
                'id_user_kasir' => $this->session->userdata('id_user'),
                'id_objek' => $id_objek,
                'waktu_transaksi' => date('Y-m-d H:i:s'),
                'total_harga' => $total_harga,
                'status_transaksi' => 'Lunas'
            ];

            $kode_tiket = 'TKT-' . date('Ymd') . '-' . bin2hex(random_bytes(6));
            $data_tiket = [
                'id_transaksi' => 0,
                'kode_tiket' => $kode_tiket,
                'status_tiket' => 'BELUM_DIPAKAI'
            ];

            $id_transaksi = $this->M_kasir->simpan_transaksi($data_transaksi, $data_detail, $data_tiket);

            if ($id_transaksi) {
                echo json_encode([
                    'status' => 'sukses',
                    'id_transaksi' => $id_transaksi
                ]);
            } else {
                // Cek database error
                $db_error = $this->db->error();
                log_message('error', 'Database error: ' . print_r($db_error, true));
                echo json_encode([
                    'status' => 'gagal',
                    'message' => 'Terjadi kesalahan saat menyimpan data. Periksa koneksi database.'
                ]);
            }
        } catch (Exception $e) {
            log_message('error', 'Exception in proses_transaksi: ' . $e->getMessage());
            echo json_encode([
                'status' => 'gagal',
                'message' => 'Error: ' . $e->getMessage()
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

        $data['struk'] = $this->M_kasir->get_struk_by_id($id_transaksi);

        if (empty($data['struk']['transaksi'])) {
            show_404();
        }

        // Batasi akses: Admin bisa lihat semua, Kasir hanya miliknya
        if (!is_admin() && $data['struk']['transaksi']['id_user_kasir'] != get_current_user_id()) {
            $this->session->set_flashdata('error', 'Anda tidak dapat mengakses transaksi ini!');
            redirect('kasir');
        }

        $this->load->view('kasir/v_struk', $data);
    }
}