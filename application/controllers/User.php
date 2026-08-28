<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();
        check_role('Admin');
        $this->load->model('M_user');
    }

    /**
     * Halaman daftar User
     */
    public function index()
    {
        $data['judul_halaman'] = 'Manajemen User';
        $data['users'] = $this->M_user->get_all_users();

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('user/v_user_index', $data); 
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Halaman form tambah
     */
    public function tambah()
    {
        $data['judul_halaman'] = 'Tambah User';

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('user/v_user_tambah', $data); 
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Proses tambah data
     */
    public function proses_tambah()
    {
        // 1. Mengatur aturan validasi
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[tbl_user.username]');
        
        // [PERBAIKAN DI SINI] Mengubah min_length[5] menjadi min_length[8]
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        
        $this->form_validation->set_rules('level', 'Level', 'trim|required');

        // (Menambahkan pesan error custom untuk validasi)
        $this->form_validation->set_message('is_unique', '%s ini sudah terdaftar.');
        $this->form_validation->set_message('min_length', '%s minimal harus %s karakter.');

        // 2. Menjalankan validasi
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi GAGAL, tampilkan kembali form tambah
            $this->tambah();
        } else {
            // Jika validasi SUKSES
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => $this->input->post('level')
            ];
            $this->M_user->tambah_user($data);
            $this->session->set_flashdata('sukses', 'Data user berhasil ditambahkan.');
            redirect('user');
        }
    }

    /**
     * Halaman form edit
     */
    public function edit($id_user)
    {
        $data['judul_halaman'] = 'Edit User';
        $data['user'] = $this->M_user->get_user_by_id($id_user);

        if ( ! $data['user']) {
            redirect('user');
        }

        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('user/v_user_edit', $data); 
        $this->load->view('template/v_footer', $data);
    }

    /**
     * Proses edit data
     */
    public function proses_edit($id_user)
    {
        $user_lama = $this->M_user->get_user_by_id($id_user);

        // Aturan validasi
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');

        if ($this->input->post('username') != $user_lama['username']) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[tbl_user.username]');
            $this->form_validation->set_message('is_unique', '%s ini sudah terdaftar.');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
        }

        // [PERBAIKAN DI SINI] Menambahkan validasi password HANYA JIKA diisi
        if ( ! empty($this->input->post('password'))) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            $this->form_validation->set_message('min_length', '%s minimal harus %s karakter.');
        }

        // Jalankan validasi
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_user);
        } else {
            // Siapkan data update
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'level' => $this->input->post('level')
            ];

            // Cek apakah password diisi (jika ya, update password)
            if ( ! empty($this->input->post('password'))) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->M_user->update_user($id_user, $data);
            $this->session->set_flashdata('sukses', 'Data user berhasil diperbarui.');
            redirect('user');
        }
    }

    /**
     * Proses hapus data
     */
     public function hapus($id_user)
    {
        $user = $this->M_user->get_user_by_id($id_user);

        if (!$user) {
            $this->session->set_flashdata('error', 'Data user tidak ditemukan!');
            redirect('user');
        }

        $result = $this->M_user->hapus_user($id_user);

        if ($result) {
            $this->session->set_flashdata('sukses', 'Data user berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data user. User mungkin masih digunakan dalam transaksi.');
        }

        redirect('user');
    }
}