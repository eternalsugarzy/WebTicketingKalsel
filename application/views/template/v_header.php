<!DOCTYPE html>
<html lang="id">

<head>
  <title><?php echo isset($judul_halaman) ? $judul_halaman : 'Dashboard'; ?> | Tiket Wisata Kalsel</title>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Sistem Informasi E-Ticketing Objek Wisata Kalimantan Selatan">
  <meta name="author" content="Muhammad Irwan Firmanto">

  <link rel="icon" href="<?php echo base_url('assets/img/wonderfulkalsel.png'); ?>" type="image/png">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">

  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/tabler-icons.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/feather.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/fontawesome.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/material.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" id="main-style-link">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style-preset.css'); ?>">

  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

  <style>
    /* Mempercantik Scrollbar Browser */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }
    ::-webkit-scrollbar-thumb {
      background: #c1c1c1; 
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #a8a8a8; 
    }

    /* Penyesuaian TomSelect agar lebih modern */
    .ts-control {
      border-radius: 6px !important;
      padding: 8px 12px !important;
      border: 1px solid #dee2e6;
    }
    .ts-wrapper.focus .ts-control {
      box-shadow: 0 0 0 0.2rem rgba(70, 128, 255, 0.25) !important;
      border-color: #4680ff !important;
    }
  </style>

</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
  
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>