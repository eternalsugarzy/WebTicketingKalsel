<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_login')) {
    function check_login() {
        $CI =& get_instance();
        if (!$CI->session->userdata('username')) {
            $CI->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
            redirect('auth');
        }
    }
}

if (!function_exists('check_role')) {
    function check_role($allowed_roles) {
        $CI =& get_instance();
        $user_level = $CI->session->userdata('level');

        $allowed = is_array($allowed_roles) ? $allowed_roles : [$allowed_roles];

        if (!in_array($user_level, $allowed)) {
            $CI->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini!');
            redirect('dashboard');
        }
    }
}

if (!function_exists('is_admin')) {
    function is_admin() {
        $CI =& get_instance();
        return $CI->session->userdata('level') === 'Admin';
    }
}

if (!function_exists('get_current_user_id')) {
    function get_current_user_id() {
        $CI =& get_instance();
        return $CI->session->userdata('id_user');
    }
}
