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
              <li class="breadcrumb-item"><a href="<?php echo base_url('jenis_tiket'); ?>">Manajemen Jenis Tiket</a></li>
              <li class="breadcrumb-item" aria-current="page"><?php echo $judul_halaman; ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5>Form Edit Kategori Tiket</h5>
          </div>
          <div class="card-body">
            
            <?php echo form_open('jenis_tiket/proses_edit/' . $tiket['id_jenis_tiket']); ?>
              
              <input type="hidden" name="id_jenis_tiket" value="<?php echo $tiket['id_jenis_tiket']; ?>">

              <div class="mb-3">
                <label for="nama_tiket" class="form-label">Nama Kategori Tiket</label>
                <input type="text" class="form-control" id="nama_tiket" name="nama_tiket" 
                       value="<?php echo set_value('nama_tiket', $tiket['nama_tiket']); ?>" 
                       placeholder="Contoh: Dewasa, Anak, Mahasiswa...">
                <?php echo form_error('nama_tiket', '<small class="text-danger">', '</small>'); ?>
              </div>

              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?php echo base_url('jenis_tiket'); ?>" class="btn btn-secondary">Batal</a>
              
            <?php echo form_close(); ?>
            </div>
        </div>
      </div>
    </div>
    </div>
</div>