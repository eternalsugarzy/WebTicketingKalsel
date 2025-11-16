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
      <div class="col-md-7">
        <div class="card shadow-sm">
          <div class="card-body">
            
            <div id="qr-reader" style="width: 100%; max-width: 600px; margin: auto;"></div>

          </div>
        </div>
      </div>
      
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5>Hasil Scan Terakhir</h5>
          </div>
          <div class="card-body" id="area_hasil_scan">
            <p class="text-muted text-center">Pilih "Start Scanning" atau upload gambar QR...</p>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>