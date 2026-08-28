<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objek_wisata extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();
        check_role('Admin');
        $this->load->model('M_objek_wisata');
        $this->load->library('pagination');
    }

    public function index()
    {
        $filter_kabupaten = $this->input->get('filter_kabupaten');
        $search_query = $this->input->get('search_query');

        // --- KONFIGURASI PAGINATION ---
        $config['base_url'] = base_url('objek_wisata/index');
        // Hitung total data
        $config['total_rows'] = $this->M_objek_wisata->count_all_objek($filter_kabupaten, $search_query);
        $config['per_page'] = 10; // Tampilkan 5 data per halaman
        $config['reuse_query_string'] = TRUE; // Agar filter tidak hilang saat pindah halaman
        
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
        
        // Ambil Offset (Halaman ke berapa)
        $start = $this->uri->segment(3);

        $data['judul_halaman'] = 'Manajemen Objek Wisata';
        
        // [MODIFIKASI] Ambil data dengan limit & start
        $data['objek_wisata'] = $this->M_objek_wisata->get_all_objek($filter_kabupaten, $search_query, $config['per_page'], $start);
        
        $data['kabupaten_list'] = $this->M_objek_wisata->get_all_kabupaten();
        
        // [BARU] Data Pagination untuk View
        $data['pagination'] = $this->pagination->create_links();
        $data['start'] = $start;

        $data['selected_kabupaten'] = $filter_kabupaten;
        $data['current_search'] = $search_query;

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('objek_wisata/v_objek_index', $data);
        $this->load->view('template/v_footer', $data);
    }

    // --- FUNGSI LAIN DI BAWAH INI TETAP SAMA ---

    public function detail($id_objek)
    {
        $data['judul_halaman'] = 'Detail Objek Wisata';
        $data['objek'] = $this->M_objek_wisata->get_objek_by_id($id_objek);

        if (!$data['objek']) {
            redirect('objek_wisata');
        }

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('objek_wisata/v_objek_detail', $data);
        $this->load->view('template/v_footer', $data);
    }

    public function tambah()
    {
        $data['judul_halaman'] = 'Tambah Objek Wisata';
        $data['kabupaten'] = $this->M_objek_wisata->get_all_kabupaten(); 

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('objek_wisata/v_objek_tambah', $data);
        $this->load->view('template/v_footer', $data);
    }

    public function proses_tambah()
    {
        $this->form_validation->set_rules('nama_objek', 'Nama Objek Wisata', 'trim|required');
        $this->form_validation->set_rules('id_kabupaten', 'Kabupaten/Kota', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $foto = $this->_upload_gambar();

            $data = [
                'nama_objek' => $this->input->post('nama_objek'),
                'id_kabupaten' => $this->input->post('id_kabupaten'),
                'alamat' => $this->input->post('alamat'),
                'deskripsi' => $this->input->post('deskripsi'),
                'foto' => $foto
            ];
            $this->M_objek_wisata->tambah_objek($data);
            $this->session->set_flashdata('sukses', 'Data objek wisata berhasil ditambahkan.');
            redirect('objek_wisata');
        }
    }

    public function edit($id_objek)
    {
        $data['judul_halaman'] = 'Edit Objek Wisata';
        $data['objek'] = $this->M_objek_wisata->get_objek_by_id($id_objek);
        $data['kabupaten'] = $this->M_objek_wisata->get_all_kabupaten(); 

        if ( ! $data['objek']) {
            redirect('objek_wisata');
        }

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('objek_wisata/v_objek_edit', $data);
        $this->load->view('template/v_footer', $data);
    }

    public function proses_edit($id_objek)
    {
        $this->form_validation->set_rules('nama_objek', 'Nama Objek Wisata', 'trim|required');
        $this->form_validation->set_rules('id_kabupaten', 'Kabupaten/Kota', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_objek);
        } else {
            $data = [
                'nama_objek' => $this->input->post('nama_objek'),
                'id_kabupaten' => $this->input->post('id_kabupaten'),
                'alamat' => $this->input->post('alamat'),
                'deskripsi' => $this->input->post('deskripsi')
            ];

            if (!empty($_FILES['foto']['name'])) {
                $foto_baru = $this->_upload_gambar();
                if ($foto_baru !== null) {
                    $data['foto'] = $foto_baru;
                }
            }

            $this->M_objek_wisata->update_objek($id_objek, $data);
            $this->session->set_flashdata('sukses', 'Data objek wisata berhasil diperbarui.');
            redirect('objek_wisata');
        }
    }

    public function hapus($id_objek)
    {
        $objek = $this->M_objek_wisata->get_objek_by_id($id_objek);

        if (!$objek) {
            $this->session->set_flashdata('error', 'Data objek wisata tidak ditemukan!');
            redirect('objek_wisata');
        }

        // Cek apakah objek masih dipakai transaksi
        if (!$this->M_objek_wisata->can_delete($id_objek)) {
            $this->session->set_flashdata('error', 'Objek wisata tidak dapat dihapus karena masih ada transaksi terkait!');
            redirect('objek_wisata');
        }

        // Hapus foto lama jika bukan default
        if ($objek->foto != 'default.jpg' && file_exists('./uploads/objek_wisata/' . $objek->foto)) {
            @unlink('./uploads/objek_wisata/' . $objek->foto);
        }

        $result = $this->M_objek_wisata->hapus_objek($id_objek);

        if ($result) {
            $this->session->set_flashdata('sukses', 'Data objek wisata berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data objek wisata.');
        }

        redirect('objek_wisata');
    }

    private function _upload_gambar()
    {
        if (empty($_FILES['foto']['name'])) {
            return null;
        }

        $upload_path = './uploads/objek_wisata/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = 'wisata_' . time();
        $config['overwrite'] = false;
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data('file_name');
        }
        return null;
    }
}