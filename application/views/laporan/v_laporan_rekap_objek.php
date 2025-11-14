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
            <form action="<?php echo base_url('laporan/rekap_objek'); ?>" method="GET">
              <div class="row g-3 align-items-end">
                
                <div class="col-md-3">
                  <label class="form-label">Dari Tanggal</label>
                  <input type="date" name="tgl_mulai" class="form-control" 
                         value="<?php echo html_escape($tgl_mulai); ?>">
                </div>
                
                <div class="col-md-3">
                  <label class="form-label">Sampai Tanggal</label>
                  <input type="date" name="tgl_selesai" class="form-control" 
                         value="<?php echo html_escape($tgl_selesai); ?>">
                </div>

                <div class="col-md-3">
                  <label class="form-label">Filter per Kabupaten/Kota</label>
                  <select name="id_kabupaten" id="id_kabupaten_filter_rekap">
                    <option value="">Semua Kabupaten</option>
                    <?php foreach ($kabupaten_list as $kab) : ?>
                      <option value="<?php echo $kab['id_kabupaten']; ?>" 
                              <?php echo ($kab['id_kabupaten'] == $selected_kabupaten) ? 'selected' : ''; ?>>
                        <?php echo html_escape($kab['nama_kabupaten']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-3 d-flex">
                  <button type="submit" class="btn btn-primary flex-grow-1 me-2">Tampilkan</button>
                  
                  <button type="submit" 
                          formaction="<?php echo base_url('laporan/cetak_pdf_rekap_objek'); ?>" 
                          formtarget="_blank"
                          class="btn btn-outline-secondary">
                    <i class="ti ti-printer"></i> PDF
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
            <h5>Rekapitulasi per Objek Wisata</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Objek Wisata</th>
                    <th>Kabupaten/Kota</th>
                    <th class="text-center">Total Transaksi</th>
                    <th class="text-center">Total Pengunjung</th>
                    <th class="text-end">Total Pendapatan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php if (empty($laporan_rekap)): ?>
                    <tr>
                      <td colspan="6" class="text-center">Tidak ada data transaksi pada rentang tanggal/filter ini.</td>
                    </tr>
                  <?php endif; ?>
                  
                  <?php foreach ($laporan_rekap as $rekap) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $rekap['nama_objek']; ?></td>
                    <td><?php echo $rekap['nama_kabupaten']; ?></td>
                    <td class="text-center"><?php echo number_format($rekap['total_transaksi'] ?? 0); ?></td>
                    <td class="text-center"><?php echo number_format($rekap['total_pengunjung'] ?? 0); ?> Orang</td>
                    <td class="text-end">Rp <?php echo number_format($rekap['total_pendapatan'] ?? 0, 0, ',', '.'); ?></td>
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