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
              <li class="breadcrumb-item"><a href="<?php echo base_url('user'); ?>">Manajemen User</a></li>
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
            <h5>Form Edit Pengguna</h5>
          </div>
          <div class="card-body">
            
            <?php echo form_open('user/proses_edit/' . $user['id_user']); ?>
              
              <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">

              <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                       value="<?php echo set_value('nama_lengkap', $user['nama_lengkap']); ?>">
                <?php echo form_error('nama_lengkap', '<small class="text-danger">', '</small>'); ?>
              </div>
              
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" 
                       value="<?php echo set_value('username', $user['username']); ?>">
                <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
              </div>
              
              <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-select" id="level" name="level">
                  <option value="">-- Pilih Level --</option>
                  <option value="Admin" <?php echo set_select('level', 'Admin', ($user['level'] == 'Admin')); ?>>Admin</option>
                  <option value="Kasir" <?php echo set_select('level', 'Kasir', ($user['level'] == 'Kasir')); ?>>Kasir</option>
                  <option value="Petugas" <?php echo set_select('level', 'Petugas', ($user['level'] == 'Petugas')); ?>>Petugas</option>
                </select>
                <?php echo form_error('level', '<small class="text-danger">', '</small>'); ?>
              </div>

              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?php echo base_url('user'); ?>" class="btn btn-secondary">Batal</a>
              
            <?php echo form_close(); ?>
            </div>
        </div>
      </div>
    </div>
    </div>
</div>