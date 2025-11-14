<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi <?php echo $tgl_mulai; ?> s/d <?php echo $tgl_selesai; ?></title>
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
        .total-row td, .total-row th { font-weight: bold; background-color: #f2f2f2; }
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

    <h1>LAPORAN REKAPITULASI PER OBJEK WISATA</h1>

    <div class="info">
        <strong>Periode:</strong> <?php echo date('d M Y', strtotime($tgl_mulai)); ?> s/d <?php echo date('d M Y', strtotime($tgl_selesai)); ?>
        <br>
        <strong>Kabupaten/Kota:</strong> <?php echo $nama_kabupaten; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Objek Wisata</th>
                <th>Kabupaten/Kota</th>
                <th class="text-center">Total Transaksi</th>
                <th class="text-center">Total Pengunjung</th>
                <th class="text-right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                $grand_total_transaksi = 0;
                $grand_total_pengunjung = 0;
                $grand_total_pendapatan = 0;
            ?>
            <?php if (empty($laporan_rekap)): ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($laporan_rekap as $rekap) : ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo html_escape($rekap['nama_objek']); ?></td>
                <td><?php echo html_escape($rekap['nama_kabupaten']); ?></td>
                <td class="text-center"><?php echo number_format($rekap['total_transaksi'] ?? 0); ?></td>
                <td class="text-center"><?php echo number_format($rekap['total_pengunjung'] ?? 0); ?></td>
                <td class="text-right">Rp <?php echo number_format($rekap['total_pendapatan'] ?? 0, 0, ',', '.'); ?></td>
            </tr>
            <?php 
                $grand_total_transaksi += $rekap['total_transaksi'] ?? 0;
                $grand_total_pengunjung += $rekap['total_pengunjung'] ?? 0;
                $grand_total_pendapatan += $rekap['total_pendapatan'] ?? 0;
            ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <th colspan="3" class="text-right">GRAND TOTAL</th>
                <th class="text-center"><?php echo number_format($grand_total_transaksi); ?></th>
                <th class="text-center"><?php echo number_format($grand_total_pengunjung); ?></th>
                <th class="text-right">Rp <?php echo number_format($grand_total_pendapatan, 0, ',', '.'); ?></th>
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