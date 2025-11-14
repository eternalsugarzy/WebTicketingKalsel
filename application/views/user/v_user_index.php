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
            <h5>Daftar Pengguna Sistem</h5>
            <div class="card-header-right">
              <a href="<?php echo base_url('user/tambah'); ?>" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah Data
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($users as $user) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $user['nama_lengkap']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td>
                        <?php if($user['level'] == 'Admin'): ?>
                            <span class="badge bg-light-primary"><?php echo $user['level']; ?></span>
                        <?php elseif($user['level'] == 'Kasir'): ?>
                            <span class="badge bg-light-success"><?php echo $user['level']; ?></span>
                        <?php else: ?>
                            <span class="badge bg-light-warning"><?php echo $user['level']; ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                      <a href="<?php echo base_url('user/edit/' . $user['id_user']); ?>" class="btn btn-warning btn-sm">
                        <i class="ti ti-edit"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger btn-sm btn-hapus" 
                              data-url="<?php echo base_url('user/hapus/' . $user['id_user']); ?>">
                        <i class="ti ti-trash" style="font-size: 0.9rem;"></i>
                      </button>

                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>