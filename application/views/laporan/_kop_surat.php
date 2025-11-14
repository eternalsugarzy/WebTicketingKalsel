<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        /* CSS UTAMA UNTUK KOP SURAT */
        @page {
            size: A4 portrait;
            margin: 20mm; /* Atur margin 2cm di semua sisi */
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }

        /* LOGO ABSOLUTE (Ditempatkan di luar flow dokumen) */
        .logo-abs {
            position: absolute;
            top: 0; 
            left: 0; 
            width: 100px; 
            height: auto;
            z-index: 100;
            margin-top: 20px;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            padding-bottom: 5px;
        }

        .kop-table td {
            padding: 0;
            padding-bottom: 5px; 
            border: none; 
            vertical-align: middle;
        }

        .kop-table .text-col {
            /* [PERBAIKAN] Mengurangi padding-left dari 95px menjadi 50px */
            padding-left: 50px; 
            text-align: center; 
        }
        
        /* Gaya Baris Teks */
        .text-col p {
            margin: 0;
            line-height: 1.25; 
            color: #000;
        }
        .text-col .line1 {
            font-size: 14pt; 
            font-weight: bold;
            text-transform: uppercase; 
        }
        .text-col .line2 {
            font-size: 18pt; 
            font-weight: bold;
            text-transform: uppercase;
        }
        
        /* Gaya Baris Kontak yang sekarang digabung ke dalam .text-col */
        .text-col .line-contact-utama {
            font-size: 10pt;
            line-height: 1.2;
            margin-top: 5px;
        }
        .text-col .line-contact-utama a {
            color: black;
            text-decoration: none;
        }

        /* Garis Pemisah KOP dan Isi Laporan */
        .hr-separator {
            border: 1px solid black; 
            margin-top: 5px; 
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <img class="logo-abs" src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo Kalsel">

    <div class="kop-wrapper">
        <table class="kop-table" style="margin-bottom: 0;">
            <tr>
                <td style="width: 2%; border: none;"></td> 
                
                <td class="text-col" style="width: 78%;">       
                    <p class="line1">PEMERINTAH PROVINSI KALIMANTAN SELATAN</p>
                    <p class="line2">DINAS PARIWISATA</p>
                    
                    <p class="line-contact-utama">Jalan Jenderal Ahmad Yani KM 7,5 Kertak Hanyar, Kab. Banjar 70654</p>
                    <p class="line-contact-utama">Telepon: (0511) 6795599 Laman: dispar.kalselprov.go.id, Pos-el: disparprovkalsel@gmail.com</p>
                </td>
            </tr>
        </table>
    </div>
    
    <hr class="hr-separator"> 
    
</body>
</html>