<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kunjungan <?php echo $tgl_mulai; ?> s/d <?php echo $tgl_selesai; ?></title>
    <style>
        /* (CSS di sini sama persis dengan v_laporan_cetak_a4.php) */
        @page { size: A4 portrait; margin: 2cm; }
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .kop-surat { text-align: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 30px; }
        .kop-surat img { width: 60px; float: left; margin-left: 20px; margin-right: -80px; }
        .kop-surat h2 { margin: 0; font-size: 18px; }
        .kop-surat h3 { margin: 5px 0 0 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 5px 0 0 0; font-size: 12px; }
        h1 { text-align: center; font-size: 16px; margin-bottom: 20px; text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { border: 1px solid #000; padding: 8px; text-align: left; }
        table th { background-color: #f2f2f2; text-align: center; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .info { margin-bottom: 20px; }
        .tanda-tangan { margin-top: 50px; width: 100%; }
        .ttd-kanan { width: 40%; float: right; text-align: center; }
        .ttd-kiri { width: 40%; float: left; text-align: center; }
        .ttd-spacer { height: 60px; }
    </style>
</head>
<body>
    <?php $this->load->view('laporan/_kop_surat'); ?>

    <h1>LAPORAN KUNJUNGAN (TIKET DI-SCAN)</h1>

    <div class="info">
        <strong>Periode:</strong> <?php echo date('d M Y', strtotime($tgl_mulai)); ?> s/d <?php echo date('d M Y', strtotime($tgl_selesai)); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu Scan</th>
                <th>Kode Tiket</th>
                <th>Objek Wisata</th>
                <th>Jml. Org</th>
                <th>Petugas Gerbang</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $total_pengunjung = 0; ?>
            <?php if (empty($laporan_kunjungan)): ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($laporan_kunjungan as $laporan) : ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($laporan['waktu_validasi'])); ?></td>
                <td><?php echo html_escape($laporan['kode_tiket']); ?></td>
                <td><?php echo html_escape($laporan['nama_objek']); ?></td>
                <td class="text-center"><?php echo $laporan['total_pengunjung']; ?></td>
                <td><?php echo html_escape($laporan['nama_petugas']); ?></td>
            </tr>
            <?php $total_pengunjung += $laporan['total_pengunjung']; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4" class="text-right">TOTAL PENGUNJUNG MASUK</td>
                <td class="text-center"><?php echo $total_pengunjung; ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="tanda-tangan">
        <div class="ttd-kanan">
            <p>Banjarmasin, <?php echo date('d F Y'); ?></p>
            <p>Mengetahui,</p>
            <div class="ttd-spacer"></div>
            <p><strong>(Nama Kepala Dinas)</strong></p>
            <p>NIP. .....................</p>
        </div>
    </div>

</body>
</html>