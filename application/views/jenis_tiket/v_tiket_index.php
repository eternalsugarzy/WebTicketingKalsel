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
            <h5>Daftar Jenis Tiket (Kategori)</h5>
            <div class="card-header-right">
              <a href="<?php echo base_url('jenis_tiket/tambah'); ?>" class="btn btn-primary btn-sm">
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
                    <th>Nama Kategori Tiket</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($jenis_tiket as $tiket) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $tiket['nama_tiket']; ?></td>
                    <td>
                      <a href="<?php echo base_url('jenis_tiket/edit/' . $tiket['id_jenis_tiket']); ?>" class="btn btn-warning btn-sm">
                        <i class="ti ti-edit"></i>
                      </a>
                      <button type="button" class="btn btn-danger btn-sm btn-hapus" 
                              data-url="<?php echo base_url('jenis_tiket/hapus/' . $tiket['id_jenis_tiket']); ?>">
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