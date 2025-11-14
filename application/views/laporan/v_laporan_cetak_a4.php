<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        /* CSS untuk mengatur tampilan A4 */
        @page {
            size: A4 portrait; /* Ukuran A4, potrait */
            margin: 2cm; /* Margin 2cm keliling */
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .kop-surat img {
    width: 60px; /* Diperkecil dari 80px */
    float: left;
    margin-left: 20px;
    margin-right: -80px; /* Mungkin perlu disesuaikan jika logo terlalu kecil */
}
        .kop-surat h2 {
            margin: 0;
            font-size: 18px;
        }
        .kop-surat h3 {
            margin: 5px 0 0 0;
            font-size: 16px;
            font-weight: normal;
        }
        .kop-surat p {
            margin: 5px 0 0 0;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .total-row td {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .info {
            margin-bottom: 20px;
        }
        .tanda-tangan {
            margin-top: 50px;
            width: 100%;
        }
        .ttd-kanan {
            width: 40%;
            float: right;
            text-align: center;
        }
        .ttd-kiri {
            width: 40%;
            float: left;
            text-align: center;
        }
        .ttd-spacer {
            height: 60px; /* Ruang untuk TTD basah */
        }
    </style>
</head>
<body>
    
<?php $this->load->view('laporan/_kop_surat'); ?>

    <h1>LAPORAN PENJUALAN TIKET</h1>

    <div class="info">
        <strong>Periode:</strong> <?php echo date('d M Y', strtotime($tgl_mulai)); ?> s/d <?php echo date('d M Y', strtotime($tgl_selesai)); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>No. Transaksi</th>
                <th>Objek Wisata</th>
                <th>Kasir</th>
                <th class="text-right">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $grand_total = 0; ?>
            <?php if (empty($laporan_penjualan)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data transaksi pada rentang tanggal ini.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($laporan_penjualan as $laporan) : ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($laporan['waktu_transaksi'])); ?></td>
                <td style="text-align: center;"><?php echo $laporan['id_transaksi']; ?></td>
                <td><?php echo html_escape($laporan['nama_objek']); ?></td>
                <td><?php echo html_escape($laporan['nama_kasir']); ?></td>
                <td class="text-right">Rp <?php echo number_format($laporan['total_harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php $grand_total += $laporan['total_harga']; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right"><strong>GRAND TOTAL</strong></td>
                <td class="text-right"><strong>Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="tanda-tangan">
        <div class="ttd-kiri">
            <p>Mengetahui,</p>
            <p>Pejabat Dinas Terkait</p>
            <div class="ttd-spacer"></div>
            <p><strong>(Nama Pejabat)</strong></p>
            <p>NIP. .....................</p>
        </div>
        <div class="ttd-kanan">
            <p>Banjarmasin, <?php echo date('d F Y'); ?></p>
            <p>Kepala Dinas</p>
            <div class="ttd-spacer"></div>
            <p><strong>IWAN FITRIADI, SH.,MH</strong></p>
            <p>NIP 19612251998031004</p>
        </div>
    </div>

</body>
</html>