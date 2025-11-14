<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    /**
     * Cek user di database berdasarkan username
     */
    public function cek_login($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('tbl_user');
        
        // Cek jika user ada
        if ($query->num_rows() > 0) {
            return $query->row(); // Kembalikan data user
        } else {
            return false; // Kembalikan false
        }
    }
}