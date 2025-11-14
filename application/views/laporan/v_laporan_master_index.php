<div class="pc-container">
  <div class="pc-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?php echo $judul_halaman; ?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item" aria-current="page"><?php echo $judul_halaman; ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5>Pilih Data Master yang Ingin Dicetak</h5>
          </div>
          <div class="card-body">
            <p>Silakan pilih salah satu laporan data master di bawah ini untuk dicetak dalam format PDF A4.</p>
            
            <div class="list-group">
              <a href="<?php echo base_url('laporan/cetak_pdf_master_objek'); ?>" target="_blank" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><i class="ti ti-map-pin me-2"></i> Laporan Daftar Objek Wisata</h5>
                  <small><i class="ti ti-printer"></i> Cetak</small>
                </div>
                <p class="mb-1">Mencetak seluruh daftar objek wisata yang terdaftar di sistem, lengkap dengan kabupaten/kotanya.</p>
              </a>
              
              <a href="<?php echo base_url('laporan/cetak_pdf_master_harga'); ?>" target="_blank" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><i class="ti ti-tag me-2"></i> Laporan Daftar Harga Tiket</h5>
                  <small><i class="ti ti-printer"></i> Cetak</small>
                </div>
                <p class="mb-1">Mencetak seluruh daftar harga tiket yang telah diatur untuk setiap objek wisata dan kategori tiket.</p>
              </a>

              <a href="<?php echo base_url('laporan/cetak_pdf_master_user'); ?>" target="_blank" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><i class="ti ti-users me-2"></i> Laporan Daftar Pengguna (User)</h5>
                  <small><i class="ti ti-printer"></i> Cetak</small>
                </div>
                <p class="mb-1">Mencetak daftar semua pengguna yang terdaftar di sistem (Admin, Kasir, Petugas).</p>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
    </div>
</div>