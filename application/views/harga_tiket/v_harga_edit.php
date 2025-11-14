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
              <li class="breadcrumb-item"><a href="<?php echo base_url('harga_tiket'); ?>">Manajemen Harga Tiket</a></li>
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
            <h5>Form Edit Harga Tiket</h5>
          </div>
          <div class="card-body">
            
            <?php echo form_open('harga_tiket/proses_edit/' . $harga['id_harga']); ?>
              
              <input type="hidden" name="id_harga" value="<?php echo $harga['id_harga']; ?>">

              <div class="mb-3">
                <label for="id_objek" class="form-label">Objek Wisata</label>
                <select class="form-select" id="id_objek" name="id_objek">
                  <option value="">-- Pilih Objek Wisata --</option>
                  <?php foreach ($objek_wisata as $objek) : ?>
                    <option value="<?php echo $objek['id_objek']; ?>" 
                            <?php echo set_select('id_objek', $objek['id_objek'], ($harga['id_objek'] == $objek['id_objek'])); ?>>
                      <?php echo $objek['nama_objek']; ?> (<?php echo $objek['nama_kabupaten']; ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('id_objek', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3">
                <label for="id_jenis_tiket" class="form-label">Kategori Tiket</label>
                <select class="form-select" id="id_jenis_tiket" name="id_jenis_tiket">
                  <option value="">-- Pilih Kategori Tiket --</option>
                  <?php foreach ($jenis_tiket as $tiket) : ?>
                    <option value="<?php echo $tiket['id_jenis_tiket']; ?>" 
                            <?php echo set_select('id_jenis_tiket', $tiket['id_jenis_tiket'], ($harga['id_jenis_tiket'] == $tiket['id_jenis_tiket'])); ?>>
                      <?php echo $tiket['nama_tiket']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('id_jenis_tiket', '<small class="text-danger">', '</small>'); ?>
              </div>
              
              <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" class="form-control" id="harga" name="harga" 
                       value="<?php echo set_value('harga', $harga['harga']); ?>" placeholder="Contoh: 10000">
                <?php echo form_error('harga', '<small class="text-danger">', '</small>'); ?>
              </div>

              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?php echo base_url('harga_tiket'); ?>" class="btn btn-secondary">Batal</a>
              
            <?php echo form_close(); ?>
            </div>
        </div>
      </div>
    </div>
    </div>
</div>