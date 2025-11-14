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
    <form id="form_kasir" method="POST">
      <div class="row">
        <div class="col-md-7">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5>Pilih Tiket</h5>
            </div>
            <div class="card-body">
              
              <div class="mb-3">
                <label for="id_objek" class="form-label">Pilih Objek Wisata</label>
                <select class="form-select" id="id_objek" name="id_objek" required>
                  <option value="">-- Pilih Objek Wisata --</option>
                  <?php foreach ($objek_wisata as $objek) : ?>
                    <option value="<?php echo $objek['id_objek']; ?>">
                      <?php echo $objek['nama_objek']; ?> (<?php echo $objek['nama_kabupaten']; ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              
              <hr>

              <div id="area_daftar_tiket">
                <p class="text-muted text-center">Silakan pilih Objek Wisata terlebih dahulu...</p>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5>Detail Pembayaran</h5>
            </div>
            <div class="card-body">
              
              <div id="keranjang_belanja">
                <p class="text-muted text-center">Belum ada tiket yang dipilih.</p>
              </div>
              
              <hr>
              
              <h4>Total: <span class="float-end" id="display_total_harga">Rp 0</span></h4>

              <div class="d-grid mt-3">
                <button type="submit" id="btn_proses" class="btn btn-primary btn-lg" disabled>
                  Proses & Cetak Tiket
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </form> </div>
</div>