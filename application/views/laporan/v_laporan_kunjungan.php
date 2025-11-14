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
        <div class="card shadow-sm mb-3">
          <div class="card-body">
            <form action="<?php echo base_url('laporan/kunjungan'); ?>" method="GET">
              <div class="row g-3 align-items-end">
                
                <div class="col-md-4">
                  <label class="form-label">Dari Tanggal</label>
                  <input type="date" name="tgl_mulai" class="form-control" 
                         value="<?php echo html_escape($tgl_mulai); ?>">
                </div>
                
                <div class="col-md-4">
                  <label class="form-label">Sampai Tanggal</label>
                  <input type="date" name="tgl_selesai" class="form-control" 
                         value="<?php echo html_escape($tgl_selesai); ?>">
                </div>

                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>

                <div class="col-md-2">
                  <button type="submit" 
                          formaction="<?php echo base_url('laporan/cetak_pdf_kunjungan'); ?>" 
                          formtarget="_blank"
                          class="btn btn-outline-secondary w-100">
                    <i class="ti ti-printer"></i> Cetak PDF
                  </button>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5>Detail Laporan Kunjungan (<?php echo date('d/m/Y', strtotime($tgl_mulai)); ?> - <?php echo date('d/m/Y', strtotime($tgl_selesai)); ?>)</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Waktu Scan</th>
                    <th>Kode Tiket</th>
                    <th>Objek Wisata</th>
                    <th>Total Pengunjung</th>
                    <th>Petugas Gerbang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php if (empty($laporan_kunjungan)): ?>
                    <tr>
                      <td colspan="6" class="text-center">Tidak ada data tiket yang di-scan pada rentang tanggal ini.</td>
                    </tr>
                  <?php endif; ?>
                  
                  <?php foreach ($laporan_kunjungan as $laporan) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($laporan['waktu_validasi'])); ?></td>
                    <td><?php echo $laporan['kode_tiket']; ?></td>
                    <td><?php echo $laporan['nama_objek']; ?></td>
                    <td class="text-center"><?php echo $laporan['total_pengunjung']; ?> Orang</td>
                    <td><?php echo $laporan['nama_petugas']; ?></td>
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