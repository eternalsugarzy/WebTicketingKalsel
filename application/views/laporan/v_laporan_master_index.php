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
            <p class="mb-4">Silakan pilih salah satu laporan data master di bawah ini untuk dicetak dalam format PDF A4.</p>
            
            <div class="row g-3">
              
              <div class="col-md-4">
                <div class="card h-100 border shadow-none hover-effect">
                  <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-4">
                    <div class="avtar avtar-lg bg-light-primary text-primary mb-3">
                      <i class="ti ti-map-pin fs-2"></i>
                    </div>
                    <h5 class="mb-2">Daftar Objek Wisata</h5>
                    <p class="text-muted mb-4">Mencetak seluruh daftar objek wisata beserta detail wilayahnya.</p>
                    <a href="<?php echo base_url('laporan/cetak_pdf_master_objek'); ?>" target="_blank" class="btn btn-primary w-100 mt-auto">
                      <i class="ti ti-printer me-1"></i> Cetak PDF
                    </a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card h-100 border shadow-none hover-effect">
                  <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-4">
                    <div class="avtar avtar-lg bg-light-warning text-warning mb-3">
                      <i class="ti ti-tag fs-2"></i>
                    </div>
                    <h5 class="mb-2">Daftar Harga Tiket</h5>
                    <p class="text-muted mb-4">Mencetak daftar harga tiket berdasarkan kategori dan objek wisata.</p>
                    <a href="<?php echo base_url('laporan/cetak_pdf_master_harga'); ?>" target="_blank" class="btn btn-warning w-100 mt-auto text-white">
                      <i class="ti ti-printer me-1"></i> Cetak PDF
                    </a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card h-100 border shadow-none hover-effect">
                  <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-4">
                    <div class="avtar avtar-lg bg-light-success text-success mb-3">
                      <i class="ti ti-users fs-2"></i>
                    </div>
                    <h5 class="mb-2">Daftar Pengguna</h5>
                    <p class="text-muted mb-4">Mencetak daftar seluruh akun pengguna (Admin, Kasir, Petugas).</p>
                    <a href="<?php echo base_url('laporan/cetak_pdf_master_user'); ?>" target="_blank" class="btn btn-success w-100 mt-auto">
                      <i class="ti ti-printer me-1"></i> Cetak PDF
                    </a>
                  </div>
                </div>
              </div>

            </div>
            </div>
        </div>
      </div>
    </div>

  </div>
</div>

<style>
  .hover-effect {
    transition: transform 0.2s;
  }
  .hover-effect:hover {
    transform: translateY(-5px);
    border-color: #ccc !important;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;
  }
</style>