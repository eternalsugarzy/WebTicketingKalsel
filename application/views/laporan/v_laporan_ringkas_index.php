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
            <form action="<?php echo base_url('laporan/penjualan_ringkas'); ?>" method="GET">
              <div class="row g-3 align-items-end">
                
                <div class="col-md-4">
                  <label class="form-label">Pilih Tanggal Laporan</label>
                  <input type="date" name="tanggal" class="form-control" 
                         value="<?php echo html_escape($tanggal); ?>">
                </div>

                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
                <div class="col-md-2">
                  <button type="submit" 
                          formaction="<?php echo base_url('laporan/cetak_pdf_ringkas'); ?>" 
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
             <h5>Rekapitulasi Laporan (<?php echo date('d/m/Y', strtotime($tanggal)); ?>)</h5>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Kategori Tiket</th>
                  <th class="text-center">Jumlah Terjual</th>
                  <th class="text-end">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($laporan_ringkas)): ?>
                  <tr>
                    <td colspan="3" class="text-center">Tidak ada data.</td>
                  </tr>
                <?php endif; ?>
                
                <?php foreach ($laporan_ringkas as $laporan): ?>
                <tr>
                  <td><?php echo $laporan['nama_tiket']; ?></td>
                  <td class="text-center"><?php echo number_format($laporan['total_tiket_terjual'] ?? 0); ?></td>
                  <td class="text-end">Rp <?php echo number_format($laporan['subtotal'] ?? 0, 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr class="table-dark">
                  <td colspan="2" class="text-end"><strong>GRAND TOTAL</strong></td>
                  <td class="text-end">
                    <strong>Rp <?php echo number_format($total['total_pendapatan'] ?? 0, 0, ',', '.'); ?></strong>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>