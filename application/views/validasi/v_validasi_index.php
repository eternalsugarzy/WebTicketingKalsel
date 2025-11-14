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
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            
            <button id="btn-scan" class="btn btn-primary w-100">Mulai Scan Kamera</button>
            
            <div id="qr-reader" class="mt-3" style="width: 100%; max-width: 500px; margin: auto;"></div>
            
            <button id="btn-stop" class="btn btn-danger w-100 mt-2" style="display: none;">Hentikan Kamera</button>

          </div>
        </div>
      </div>
      
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5>Hasil Scan Terakhir</h5>
          </div>
          <div class="card-body" id="area_hasil_scan">
            <p class="text-muted text-center">Arahkan kamera ke QR Code pada struk...</p>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>