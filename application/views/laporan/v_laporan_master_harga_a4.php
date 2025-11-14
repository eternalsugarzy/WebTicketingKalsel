<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Master Harga Tiket</title>
    <style>
        /* (CSS A4 standar, sama seperti sebelumnya) */
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
        .info { margin-bottom: 20px; }
    </style>
</head>
<body>
    <?php $this->load->view('laporan/_kop_surat'); ?>

    <h1>LAPORAN DATA MASTER HARGA TIKET</h1>

    <div class="info">
        <strong>Tanggal Cetak:</strong> <?php echo date('d F Y'); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 40%;">Objek Wisata</th>
                <th style="width: 30%;">Kategori Tiket</th>
                <th style="width: 25%;" class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php if (empty($daftar_harga)): ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($daftar_harga as $harga) : ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td><?php echo html_escape($harga['nama_objek']); ?></td>
                <td><?php echo html_escape($harga['nama_tiket']); ?></td>
                <td class="text-right">Rp <?php echo number_format($harga['harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>