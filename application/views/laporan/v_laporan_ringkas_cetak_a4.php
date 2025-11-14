<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Ringkas <?php echo $tanggal; ?></title>
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
        .total-row td { font-weight: bold; background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .info { margin-bottom: 20px; }
        .tanda-tangan { margin-top: 50px; width: 100%; }
        .ttd-kanan { width: 40%; float: right; text-align: center; }
        .ttd-spacer { height: 60px; }
    </style>
</head>
<body>
    <?php $this->load->view('laporan/_kop_surat'); ?>

    <h1>LAPORAN PENJUALAN HARIAN (RINGKAS)</h1>

    <div class="info">
        <strong>Tanggal:</strong> <?php echo date('d F Y', strtotime($tanggal)); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori Tiket</th>
                <th class="text-center">Jumlah Terjual</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php if (empty($laporan_ringkas)): ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data transaksi pada tanggal ini.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($laporan_ringkas as $laporan) : ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo html_escape($laporan['nama_tiket']); ?></td>
                <td class="text-center"><?php echo number_format($laporan['total_tiket_terjual'] ?? 0); ?></td>
                <td class="text-right">Rp <?php echo number_format($laporan['subtotal'] ?? 0, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2" class="text-right"><strong>TOTAL PENDAPATAN</strong></td>
                <td class="text-center"><strong><?php echo number_format($total['total_tiket_terjual'] ?? 0); ?></strong></td>
                <td class="text-right"><strong>Rp <?php echo number_format($total['total_pendapatan'] ?? 0, 0, ',', '.'); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="tanda-tangan">
        <div class="ttd-kanan">
            <p>Banjarmasin, <?php echo date('d F Y'); ?></p>
            <p>Petugas/Kasir yang Bertugas</p>
            <div class="ttd-spacer"></div>
            <p><strong>( <?php echo $this->session->userdata('nama'); ?> )</strong></p>
            <p>NIP. .....................</p>
        </div>
    </div>

</body>
</html>