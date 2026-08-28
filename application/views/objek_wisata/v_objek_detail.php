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
              <li class="breadcrumb-item"><a href="<?php echo base_url('objek_wisata'); ?>">Manajemen Objek Wisata</a></li>
              <li class="breadcrumb-item" aria-current="page">Detail</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <?php if(!empty($objek['foto']) && $objek['foto'] != 'default.jpg'): ?>
                    <img src="<?php echo base_url('uploads/objek_wisata/'.$objek['foto']); ?>" class="img-fluid rounded" alt="<?php echo $objek['nama_objek']; ?>">
                <?php else: ?>
                    <div class="alert alert-secondary">Tidak ada foto tersedia</div>
                <?php endif; ?>
            </div>
        </div>
      </div>

      <div class="col-md-7">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5>Informasi Objek Wisata</h5>
          </div>
          <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="30%">Nama Objek</th>
                    <td>: <strong><?php echo html_escape($objek['nama_objek']); ?></strong></td>
                </tr>
                <tr>
                    <th>Kabupaten/Kota</th>
                    <td>: <?php echo html_escape($objek['nama_kabupaten']); ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: <?php echo html_escape($objek['alamat']); ?></td>
                </tr>
            </table>

            <hr>
            <h6>Deskripsi:</h6>
            <p class="text-muted" style="text-align: justify;">
                <?php echo html_escape(nl2br($objek['deskripsi'])); ?>
            </p>

            <div class="mt-4">
                <a href="<?php echo base_url('objek_wisata/edit/'.$objek['id_objek']); ?>" class="btn btn-warning">
                    <i class="ti ti-edit"></i> Edit Data
                </a>
                <a href="<?php echo base_url('objek_wisata'); ?>" class="btn btn-secondary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>