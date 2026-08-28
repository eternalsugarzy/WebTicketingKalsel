<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - <?php echo $struk['tiket']['kode_tiket']; ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            width: 300px; /* Lebar umum struk thermal */
            margin: 0 auto;
        }
        .container {
            padding: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #999;
            padding-bottom: 10px;
        }
        .header h3 {
            margin: 0;
            font-size: 16px;
        }
        .header p {
            margin: 0;
            font-size: 11px;
        }
        .content {
            margin-top: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 4px 0;
        }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .total-section {
            border-top: 1px dashed #999;
            margin-top: 10px;
            padding-top: 10px;
        }
        .total-section h4 {
            margin: 0;
            font-size: 14px;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            border-top: 1px dashed #999;
            padding-top: 10px;
        }
        .qr-code {
            text-align: center;
            margin-top: 15px;
        }
        .btn-print {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 20px 0;
            background-color: #007bff;
            color: white;
            border: none;
            text-align: center;
            cursor: pointer;
        }
        @media print {
            /* Sembunyikan tombol cetak saat di-print */
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3>TIKET MASUK</h3>
            <p><?php echo html_escape($struk['transaksi']['nama_objek']); ?></p>
            <p><?php echo html_escape($struk['transaksi']['nama_kabupaten']); ?></p>
        </div>

        <div class="content">
            <table>
                <tr>
                    <td class="text-left">No. Transaksi</td>
                    <td class="text-right"><?php echo $struk['transaksi']['id_transaksi']; ?></td>
                </tr>
                <tr>
                    <td class="text-left">Waktu</td>
                    <td class="text-right"><?php echo date('d/m/Y H:i', strtotime($struk['transaksi']['waktu_transaksi'])); ?></td>
                </tr>
                <tr>
                    <td class="text-left">Kasir</td>
                    <td class="text-right"><?php echo html_escape($struk['transaksi']['nama_kasir']); ?></td>
                </tr>
            </table>

            <hr style="border: 1px dashed #999;">

            <table>
                <thead>
                    <tr>
                        <th class="text-left">Item</th>
                        <th>Jml</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($struk['detail'] as $item): ?>
                    <tr>
                        <td class="text-left"><?php echo html_escape($item['nama_tiket']); ?></td>
                        <td style="text-align: center;"><?php echo (int)$item['jumlah']; ?></td>
                        <td class="text-right"><?php echo number_format($item['harga_saat_transaksi'], 0, ',', '.'); ?></td>
                        <td class="text-right"><?php echo number_format($item['harga_saat_transaksi'] * $item['jumlah'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total-section">
                <h4>Total: Rp <?php echo number_format($struk['transaksi']['total_harga'], 0, ',', '.'); ?></h4>
            </div>

            <div class="qr-code">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode($struk['tiket']['kode_tiket']); ?>" 
                     alt="QR Code">
                <p><?php echo html_escape($struk['tiket']['kode_tiket']); ?></p>
            </div>

            <div class="footer">
                <p>Terima kasih atas kunjungan Anda.</p>
                <p>Struk ini adalah TIKET MASUK yang SAH.</p>
            </div>
            
            <button class="btn-print" onclick="window.print()">Cetak Ulang</button>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>