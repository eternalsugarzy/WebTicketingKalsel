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
              <li class="breadcrumb-item" aria-current="page"><?php echo $judul_halaman; ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5>Form Edit Objek Wisata</h5>
          </div>
          <div class="card-body">
            
            <?php echo form_open_multipart('objek_wisata/proses_edit/' . $objek['id_objek']); ?>
              
              <input type="hidden" name="id_objek" value="<?php echo $objek['id_objek']; ?>">

              <div class="mb-3">
                <label for="nama_objek" class="form-label">Nama Objek Wisata</label>
                <input type="text" class="form-control" id="nama_objek" name="nama_objek" 
                       value="<?php echo set_value('nama_objek', $objek['nama_objek']); ?>">
                <?php echo form_error('nama_objek', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3">
                <label for="id_kabupaten" class="form-label">Kabupaten/Kota</label>
                <select class="form-select" id="id_kabupaten" name="id_kabupaten">
                  <option value="">-- Pilih Kabupaten/Kota --</option>
                  <?php foreach ($kabupaten as $kab) : ?>
                    <option value="<?php echo $kab['id_kabupaten']; ?>" 
                            <?php echo set_select('id_kabupaten', $kab['id_kabupaten'], ($objek['id_kabupaten'] == $kab['id_kabupaten'])); ?>>
                      <?php echo $kab['nama_kabupaten']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('id_kabupaten', '<small class="text-danger">', '</small>'); ?>
              </div>
              
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo set_value('alamat', $objek['alamat']); ?></textarea>
              </div>

              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Lengkap</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"><?php echo set_value('deskripsi', $objek['deskripsi']); ?></textarea>
              </div>

              <div class="mb-3">
                <label for="foto" class="form-label">Foto Objek Wisata</label>
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <?php if(!empty($objek['foto'])): ?>
                            <img src="<?php echo base_url('uploads/objek_wisata/'.$objek['foto']); ?>" class="img-thumbnail mb-2" style="max-height: 100px;">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-9">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                    </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?php echo base_url('objek_wisata'); ?>" class="btn btn-secondary">Batal</a>
              
            <?php echo form_close(); ?>
            </div>
        </div>
      </div>
    </div>
    </div>
</div>