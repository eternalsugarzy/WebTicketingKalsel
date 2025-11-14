<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
    }

    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }
        
        $this->load->view('v_login');
    }

    /**
     * Memproses data login
     */
    public function proses_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('v_login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password'); // Ini password plain text dari form

            // Ambil data user (termasuk password yg ter-hash) dari DB
            $user = $this->M_auth->cek_login($username);

            if ($user) {
                
                // [PERBAIKAN DI SINI]
                // Kita ganti pengecekan password lama
                // dengan password_verify()
                
                // Kode Lama: if ($password == 'admin123') {
                // Kode Baru:
                if (password_verify($password, $user->password)) {
                    
                    // Jika password cocok
                    $data_session = array(
                        'id_user'   => $user->id_user,
                        'nama'      => $user->nama_lengkap,
                        'username'  => $user->username,
                        'level'     => $user->level,
                        'status'    => 'login'
                    );
                    $this->session->set_userdata($data_session);

                    redirect('dashboard'); 

                } else {
                    // Jika password salah
                    $this->session->set_flashdata('error', 'Password salah!');
                    redirect('auth');
                }
                // [AKHIR PERBAIKAN]

            } else {
                // Jika user tidak ditemukan
                $this->session->set_flashdata('error', 'Username tidak ditemukan!');
                redirect('auth');
            }
        }
    }

    /**
     * Proses Logout
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}