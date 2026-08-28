<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_tiket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();
        check_role('Admin');
        $this->load->model('M_harga_tiket');
        $this->load->library('pagination');
    }

    public function index()
    {
        // Ambil Filter
        $filter_kategori = $this->input->get('filter_kategori');
        $search_query = $this->input->get('search_query');
        $filter_objek = $this->input->get('filter_objek');

        // --- KONFIGURASI PAGINATION ---
        $config['base_url'] = base_url('harga_tiket/index');
        // Hitung total data berdasarkan filter yg aktif
        $config['total_rows'] = $this->M_harga_tiket->count_all_harga($filter_kategori, $search_query, $filter_objek);
        $config['per_page'] = 10; // Ubah angka ini jika ingin menampilkan lebih banyak per halaman (misal 10)
        $config['reuse_query_string'] = TRUE; // PENTING: Agar filter tidak hilang saat klik halaman 2
        
        // Styling Pagination (Bootstrap 5)
        $config['full_tag_open']    = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close']   = '</ul></nav>';
        
        $config['first_link']       = 'First';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        
        $config['last_link']        = 'Last';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        
        $config['next_link']        = '&raquo;';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        
        $config['prev_link']        = '&laquo;';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        
        $config['attributes']       = array('class' => 'page-link');

        $this->pagination->initialize($config);

        // Menentukan offset (mulai dari data ke berapa)
        $start = $this->uri->segment(3);

        $data['judul_halaman'] = 'Manajemen Harga Tiket';

        // [MODIFIKASI] Panggil model dengan Limit & Start
        $data['daftar_harga'] = $this->M_harga_tiket->get_all_harga($filter_kategori, $search_query, $filter_objek, $config['per_page'], $start);
        
        // [BARU] Kirim link pagination ke view
        $data['pagination'] = $this->pagination->create_links();
        $data['start'] = $start; // Untuk penomoran tabel

        $data['kategori_list'] = $this->M_harga_tiket->get_jenis_tiket_list();
        $data['objek_list'] = $this->M_harga_tiket->get_objek_wisata_list();

        $data['selected_kategori'] = $filter_kategori;
        $data['selected_objek'] = $filter_objek;
        $data['current_search'] = $search_query;

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('harga_tiket/v_harga_index', $data);
        $this->load->view('template/v_footer', $data);
    }

    // --- FUNGSI TAMBAH, EDIT, HAPUS TETAP SAMA (TIDAK PERLU DIUBAH) ---
    // Copy-paste saja fungsi tambah(), proses_tambah(), edit(), proses_edit(), hapus() 
    // dari kode lama Anda ke sini, karena tidak ada perubahan di fungsi tersebut.
    
    public function tambah()
    {
        // ... (Kode sama seperti sebelumnya)
        $data['judul_halaman'] = 'Atur Harga Tiket Baru';
        $data['objek_wisata'] = $this->M_harga_tiket->get_objek_wisata_list();
        $data['jenis_tiket'] = $this->M_harga_tiket->get_jenis_tiket_list();

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('harga_tiket/v_harga_tambah', $data);
        $this->load->view('template/v_footer', $data);
    }

    public function proses_tambah()
    {
         // ... (Kode sama seperti sebelumnya)
        $this->form_validation->set_rules('id_objek', 'Objek Wisata', 'trim|required');
        $this->form_validation->set_rules('id_jenis_tiket', 'Kategori Tiket', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $id_objek = $this->input->post('id_objek');
            $id_jenis_tiket = $this->input->post('id_jenis_tiket');

            if ($this->M_harga_tiket->cek_duplikat($id_objek, $id_jenis_tiket)) {
                $this->session->set_flashdata('error', 'Harga untuk kombinasi objek wisata dan kategori tiket tersebut sudah ada!');
                $this->tambah();
            } else {
                $data = [
                    'id_objek' => $id_objek,
                    'id_jenis_tiket' => $id_jenis_tiket,
                    'harga' => $this->input->post('harga')
                ];
                $this->M_harga_tiket->tambah_harga($data);
                $this->session->set_flashdata('sukses', 'Harga tiket baru berhasil diatur.');
                redirect('harga_tiket');
            }
        }
    }

    public function edit($id_harga)
    {
         // ... (Kode sama seperti sebelumnya)
        $data['judul_halaman'] = 'Edit Harga Tiket';
        $data['harga'] = $this->M_harga_tiket->get_harga_by_id($id_harga);
        $data['objek_wisata'] = $this->M_harga_tiket->get_objek_wisata_list();
        $data['jenis_tiket'] = $this->M_harga_tiket->get_jenis_tiket_list();

        if ( ! $data['harga']) {
            redirect('harga_tiket');
        }

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('harga_tiket/v_harga_edit', $data); 
        $this->load->view('template/v_footer', $data);
    }

    public function proses_edit($id_harga)
    {
         // ... (Kode sama seperti sebelumnya)
        $this->form_validation->set_rules('id_objek', 'Objek Wisata', 'trim|required');
        $this->form_validation->set_rules('id_jenis_tiket', 'Kategori Tiket', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_harga);
        } else {
            $id_objek = $this->input->post('id_objek');
            $id_jenis_tiket = $this->input->post('id_jenis_tiket');

            if ($this->M_harga_tiket->cek_duplikat($id_objek, $id_jenis_tiket, $id_harga)) {
                $this->session->set_flashdata('error', 'Kombinasi objek dan kategori tiket tersebut sudah digunakan oleh data harga lain.');
                $this->edit($id_harga);
            } else {
                $data = [
                    'id_objek' => $id_objek,
                    'id_jenis_tiket' => $id_jenis_tiket,
                    'harga' => $this->input->post('harga')
                ];
                $this->M_harga_tiket->update_harga($id_harga, $data);
                $this->session->set_flashdata('sukses', 'Data harga tiket berhasil diperbarui.');
                redirect('harga_tiket');
            }
        }
    }

     public function hapus($id_harga)
    {
        $harga = $this->M_harga_tiket->get_harga_by_id($id_harga);

        if (!$harga) {
            $this->session->set_flashdata('error', 'Data harga tiket tidak ditemukan!');
            redirect('harga_tiket');
        }

        $result = $this->M_harga_tiket->hapus_harga($id_harga);

        if ($result) {
            $this->session->set_flashdata('sukses', 'Data harga tiket berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data harga tiket.');
        }

        redirect('harga_tiket');
    }
}