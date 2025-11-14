<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

    /**
     * Mengambil data laporan penjualan berdasarkan rentang tanggal
     */
    public function get_laporan_penjualan($tgl_mulai, $tgl_selesai)
    {
        // Set tanggal selesai agar mencakup jam 23:59:59
        $tgl_selesai = $tgl_selesai . ' 23:59:59';

        $this->db->select('
            tbl_transaksi.*, 
            tbl_objek_wisata.nama_objek, 
            tbl_user.nama_lengkap as nama_kasir
        ');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_objek_wisata', 'tbl_transaksi.id_objek = tbl_objek_wisata.id_objek');
        $this->db->join('tbl_user', 'tbl_transaksi.id_user_kasir = tbl_user.id_user');
        
        // Filter berdasarkan rentang tanggal
        $this->db->where('tbl_transaksi.waktu_transaksi >=', $tgl_mulai);
        $this->db->where('tbl_transaksi.waktu_transaksi <=', $tgl_selesai);
        
        $this->db->order_by('tbl_transaksi.waktu_transaksi', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Mengambil total pendapatan dan total tiket
     */
    public function get_total_penjualan($tgl_mulai, $tgl_selesai)
    {
        $tgl_selesai = $tgl_selesai . ' 23:59:59';

        $this->db->select('
            SUM(tbl_transaksi.total_harga) as total_pendapatan,
            COUNT(tbl_transaksi.id_transaksi) as total_transaksi,
            SUM(tbl_transaksi_detail.jumlah) as total_tiket_terjual
        ');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_transaksi_detail', 'tbl_transaksi.id_transaksi = tbl_transaksi_detail.id_transaksi');
        
        // Filter tanggal
        $this->db->where('tbl_transaksi.waktu_transaksi >=', $tgl_mulai);
        $this->db->where('tbl_transaksi.waktu_transaksi <=', $tgl_selesai);
        
        $query = $this->db->get();
        return $query->row_array(); // Kembalikan 1 baris hasil
    }

    /**
     * [FUNGSI BARU] Mengambil data laporan ringkas (total per jenis tiket)
     */
    public function get_laporan_ringkas($tanggal)
    {
        // Tentukan rentang waktu 1 hari (dari 00:00:00 sampai 23:59:59)
        $tgl_mulai = $tanggal . ' 00:00:00';
        $tgl_selesai = $tanggal . ' 23:59:59';

        $this->db->select('
            jt.nama_tiket,
            SUM(td.jumlah) as total_tiket_terjual,
            SUM(td.jumlah * td.harga_saat_transaksi) as subtotal
        ');
        $this->db->from('tbl_transaksi_detail td');
        $this->db->join('tbl_jenis_tiket jt', 'td.id_jenis_tiket = jt.id_jenis_tiket');
        $this->db->join('tbl_transaksi t', 'td.id_transaksi = t.id_transaksi');
        
        // Filter berdasarkan rentang tanggal
        $this->db->where('t.waktu_transaksi >=', $tgl_mulai);
        $this->db->where('t.waktu_transaksi <=', $tgl_selesai);

        // Kelompokkan berdasarkan nama tiket
        $this->db->group_by('jt.nama_tiket');
        $this->db->order_by('jt.nama_tiket', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * [FUNGSI BARU] Mengambil data laporan kunjungan (hasil scan)
     */
    public function get_laporan_kunjungan($tgl_mulai, $tgl_selesai)
    {
        // Set tanggal selesai agar mencakup jam 23:59:59
        $tgl_selesai = $tgl_selesai . ' 23:59:59';

        $this->db->select('
            tbl_tiket.kode_tiket,
            tbl_tiket.waktu_validasi,
            tbl_user.nama_lengkap as nama_petugas,
            tbl_objek_wisata.nama_objek,
            SUM(tbl_transaksi_detail.jumlah) as total_pengunjung
        ');
        $this->db->from('tbl_tiket');
        // Join ke petugas yang men-scan
        $this->db->join('tbl_user', 'tbl_tiket.id_user_petugas = tbl_user.id_user', 'left');
        // Join ke transaksi
        $this->db->join('tbl_transaksi', 'tbl_tiket.id_transaksi = tbl_transaksi.id_transaksi', 'left');
        // Join ke objek wisata
        $this->db->join('tbl_objek_wisata', 'tbl_transaksi.id_objek = tbl_objek_wisata.id_objek', 'left');
        // Join ke detail transaksi untuk menghitung jumlah orang
        $this->db->join('tbl_transaksi_detail', 'tbl_transaksi.id_transaksi = tbl_transaksi_detail.id_transaksi', 'left');
        
        // Filter HANYA tiket yang SUDAH DIPAKAI
        $this->db->where('tbl_tiket.status_tiket', 'SUDAH_DIPAKAI');

        // Filter berdasarkan rentang tanggal scan
        $this->db->where('tbl_tiket.waktu_validasi >=', $tgl_mulai);
        $this->db->where('tbl_tiket.waktu_validasi <=', $tgl_selesai);
        
        // Group by ID tiket
        $this->db->group_by('tbl_tiket.id_tiket');
        
        $this->db->order_by('tbl_tiket.waktu_validasi', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * [FUNGSI BARU] Mengambil data rekapitulasi per objek wisata
     */
    public function get_rekap_objek($tgl_mulai, $tgl_selesai, $id_kabupaten = null)
    {
        $tgl_selesai = $tgl_selesai . ' 23:59:59';

        $this->db->select('
            ow.nama_objek,
            k.nama_kabupaten,
            COUNT(DISTINCT t.id_transaksi) as total_transaksi,
            SUM(td.jumlah) as total_pengunjung,
            SUM(t.total_harga) as total_pendapatan
        ');
        $this->db->from('tbl_objek_wisata ow');
        $this->db->join('tbl_kabupaten k', 'ow.id_kabupaten = k.id_kabupaten');
        
        // Kita gunakan LEFT JOIN agar objek wisata yang 0 penjualannya tetap tampil
        $this->db->join('tbl_transaksi t', 'ow.id_objek = t.id_objek', 'left');
        $this->db->join('tbl_transaksi_detail td', 't.id_transaksi = td.id_transaksi', 'left');

        // Filter berdasarkan rentang tanggal scan
        // Kita harus pastikan filternya berlaku untuk data transaksi
        $this->db->where('t.waktu_transaksi >=', $tgl_mulai);
        $this->db->where('t.waktu_transaksi <=', $tgl_selesai);
        
        // [BARU] Filter berdasarkan kabupaten jika dipilih
        if ($id_kabupaten) {
            $this->db->where('ow.id_kabupaten', $id_kabupaten);
        }

        // Kunci dari laporan ini: Group By Objek Wisata
        $this->db->group_by('ow.id_objek, ow.nama_objek, k.nama_kabupaten');
        $this->db->order_by('total_pendapatan', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * [FUNGSI BARU] Membuat Laporan PDF Master User
     */
    public function cetak_pdf_master_user()
    {
        $this->load->library('pdfgenerator');

        // [BARU] Kita perlu data dari M_user
        $this->load->model('M_user');
        // Panggil fungsi get_all_users (tanpa filter)
        $data['daftar_user'] = $this->M_user->get_all_users(); 
        
        $html = $this->load->view('laporan/v_laporan_master_user_a4', $data, TRUE);
        $filename = 'Laporan_Data_Master_Pengguna';
        
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

}