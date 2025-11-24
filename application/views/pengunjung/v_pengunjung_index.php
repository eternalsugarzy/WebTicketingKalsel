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

    <div class="row mb-3">
      <div class="col-md-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <form action="" method="GET">
              <div class="row g-3 align-items-end">
                
                <div class="col-md-3">
                  <label class="form-label fw-bold">Dari Tanggal</label>
                  <input type="date" class="form-control" name="tgl_awal" value="<?php echo $f_tgl_awal; ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label fw-bold">Sampai Tanggal</label>
                  <input type="date" class="form-control" name="tgl_akhir" value="<?php echo $f_tgl_akhir; ?>">
                </div>

                <div class="col-md-2">
                  <label class="form-label fw-bold">Kabupaten/Kota</label>
                  <select class="form-select" name="id_kabupaten">
                    <option value="">-- Semua --</option>
                    <?php foreach($opt_kabupaten as $kab): ?>
                      <option value="<?php echo $kab->id_kabupaten; ?>" <?php echo ($f_id_kabupaten == $kab->id_kabupaten) ? 'selected' : ''; ?>>
                        <?php echo $kab->nama_kabupaten; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-2">
                  <label class="form-label fw-bold">Objek Wisata</label>
                  <select class="form-select" name="id_objek">
                    <option value="">-- Semua --</option>
                    <?php foreach($opt_objek as $obj): ?>
                      <option value="<?php echo $obj->id_objek; ?>" <?php echo ($f_id_objek == $obj->id_objek) ? 'selected' : ''; ?>>
                        <?php echo $obj->nama_objek; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100 mb-1">
                    <i data-feather="filter"></i> Tampilkan
                  </button>
                  <a href="<?php echo base_url('pengunjung'); ?>" class="btn btn-outline-secondary w-100">
                    Reset
                  </a>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Daftar Riwayat Kunjungan</h5>
            <span class="badge bg-primary"><?php echo count($pengunjung); ?> Data Ditemukan</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="table-pengunjung">
                <thead class="table-light">
                  <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Waktu Transaksi</th>
                    <th>ID Transaksi</th>
                    <th>Objek Wisata</th>
                    <th>Kabupaten</th> <th class="text-center">Jml. Pengunjung</th> 
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($pengunjung)) : ?>
                    <tr>
                      <td colspan="7" class="text-center py-4">
                        <div class="text-muted">
                          <i data-feather="inbox" style="width: 40px; height: 40px;"></i><br>
                          Data tidak ditemukan untuk filter ini.
                        </div>
                      </td>
                    </tr>
                  <?php else : ?>
                    <?php $no = 1; foreach($pengunjung as $row) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td><?php echo date('d-m-Y H:i', strtotime($row->waktu_transaksi)); ?></td> 
                      <td>
                        <span class="badge bg-light text-dark border">#<?php echo $row->id_transaksi; ?></span>
                      </td>
                      <td><?php echo $row->nama_objek; ?></td>
                      <td><?php echo $row->nama_kabupaten; ?></td> <td class="text-center">
                        <strong><?php echo $row->total_pengunjung; ?></strong> Orang
                      </td>
                      <td>
                        <?php if($row->status_transaksi == 'Lunas'): ?>
                            <span class="badge bg-success">Lunas</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>