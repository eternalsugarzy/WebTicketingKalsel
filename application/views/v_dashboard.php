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
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <span class="p-3 bg-light-primary text-primary rounded-3">
                        <i class="ti ti-users fs-3"></i>
                    </span>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="mb-1 text-muted">Total Pengunjung (Hari Ini)</h6>
                    <h4 class="mb-0"><?php echo number_format($total_hari_ini['total_tiket_terjual'] ?? 0); ?></h4>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <span class="p-3 bg-light-success text-success rounded-3">
                        <i class="ti ti-currency-dollar fs-3"></i>
                    </span>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="mb-1 text-muted">Total Penjualan (Hari Ini)</h6>
                    <h4 class="mb-0">Rp <?php echo number_format($total_hari_ini['total_pendapatan'] ?? 0, 0, ',', '.'); ?></h4>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="card shadow-sm h-100">
          
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Grafik Kunjungan per Kabupaten/Kota</h5>
            
            <div style="width: 160px;">
                <select id="filter_grafik" class="form-select form-select-sm shadow-none border-secondary">
                    <option value="tahun" selected>📅 Tahun Ini</option>
                    <option value="bulan">📆 Bulan Ini</option>
                    <option value="minggu">🗓️ Minggu Ini</option>
                </select>
            </div>
          </div>
          
          <div class="card-body">
            <div id="grafikPengunjungKabupaten"></div>
            
            <div id="loadingChart" class="text-center py-5" style="display:none;">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="text-muted small mt-2">Mengambil data...</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-12">
        <div class="card shadow-sm h-100">
          <div class="card-header">
            <h5>Top 5 Objek Wisata</h5>
          </div>
          <div class="card-body p-0">
            <div class="list-group list-group-flush">
              
              <?php if(empty($top_objek)): ?>
                <div class="p-3 text-center text-muted">Belum ada data transaksi.</div>
              <?php else: ?>
                <?php 
                  $rank = 1; 
                  foreach($top_objek as $top): 
                    $badgeColor = ($rank == 1) ? 'bg-warning text-dark' : (($rank == 2) ? 'bg-secondary' : 'bg-light text-dark');
                    $icon = ($rank == 1) ? '👑' : '#'.$rank;
                ?>
                <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                  <div class="d-flex align-items-center">
                    <span class="badge <?php echo $badgeColor; ?> me-3 rounded-pill" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                      <?php echo $icon; ?>
                    </span>
                    <div>
                      <h6 class="mb-0"><?php echo $top->nama_objek; ?></h6>
                      <small class="text-muted">Total Kunjungan</small>
                    </div>
                  </div>
                  <span class="fw-bold text-primary"><?php echo number_format($top->total); ?></span>
                </div>
                <?php $rank++; endforeach; ?>
              <?php endif; ?>

            </div>
          </div>
          <div class="card-footer text-center">
            <a href="<?php echo base_url('laporan/rekap_objek'); ?>" class="btn btn-sm btn-link">Lihat Semua Laporan</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Kunjungan Terbaru (Live Transaction)</h5>
            <a href="<?php echo base_url('pengunjung'); ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th class="ps-4">Waktu</th>
                    <th>Objek Wisata</th>
                    <th>ID Transaksi</th>
                    <th>Jumlah Tiket</th>
                    <th class="text-end pe-4">Total Harga</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($pengunjung_terbaru)): ?>
                    <tr>
                      <td colspan="5" class="text-center py-4 text-muted">Belum ada pengunjung hari ini.</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach($pengunjung_terbaru as $kunjungan): ?>
                    <tr>
                      <td class="ps-4">
                        <div class="d-flex flex-column">
                          <span class="fw-bold"><?php echo date('H:i', strtotime($kunjungan->waktu_transaksi)); ?></span>
                          <small class="text-muted"><?php echo date('d M Y', strtotime($kunjungan->waktu_transaksi)); ?></small>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="avtar avtar-s bg-light-primary text-primary me-2">
                            <i class="ti ti-map-pin"></i>
                          </div>
                          <span><?php echo $kunjungan->nama_objek; ?></span>
                        </div>
                      </td>
                      <td><span class="badge bg-light text-dark border">#<?php echo $kunjungan->id_transaksi; ?></span></td>
                      <td><?php echo $kunjungan->jumlah_orang; ?> Orang</td>
                      <td class="text-end pe-4 fw-bold text-success">Rp <?php echo number_format($kunjungan->total_harga, 0, ',', '.'); ?></td>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    
    // Simpan token CSRF
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

    // 1. Data Awal
    const initialLabels = <?php echo $grafik_labels_json; ?>;
    const initialData = <?php echo $grafik_data_json; ?>;
    
    var options = {
      series: [{ name: 'Total Pengunjung', data: initialData }],
      chart: { 
          type: 'bar', 
          height: 350, 
          toolbar: { show: false }, 
          fontFamily: 'inherit',
          // --- KONFIGURASI ANIMASI (AGAR SMOOTH) ---
          animations: {
              enabled: true,
              easing: 'easeinout', // Gerakan luwes
              speed: 800, // Durasi animasi (ms)
              animateGradually: {
                  enabled: true,
                  delay: 150
              },
              dynamicAnimation: {
                  enabled: true,
                  speed: 350
              }
          }
      },
      plotOptions: { 
          bar: { 
              horizontal: false, 
              columnWidth: '50%', 
              borderRadius: 4,
              dataLabels: { position: 'top' } // Label di atas batang
          } 
      },
      dataLabels: { 
          enabled: false 
      },
      stroke: { show: true, width: 2, colors: ['transparent'] },
      xaxis: { 
          categories: initialLabels, 
          axisBorder: { show: false }, 
          axisTicks: { show: false } 
      },
      yaxis: { title: { text: 'Jumlah Pengunjung' } },
      fill: { opacity: 1, colors: ['#4680ff'] },
      tooltip: { y: { formatter: function (val) { return val + " Orang" } } },
      grid: { strokeDashArray: 4 },
      noData: { 
        text: 'Tidak ada data pengunjung.', 
        align: 'center',
        verticalAlign: 'middle',
        style: { color: '#999', fontSize: '16px' }
      }
    };

    var chart = new ApexCharts(document.querySelector("#grafikPengunjungKabupaten"), options);
    chart.render();

    // 2. Event Listener Filter AJAX
    $('#filter_grafik').on('change', function() {
        var selectedFilter = $(this).val();
        
        // --- EFEK TRANSISI LOADING (FADE) ---
        // Menggunakan fadeTo agar grafik meredup perlahan, bukan hilang mendadak
        $('#grafikPengunjungKabupaten').fadeTo(300, 0.4); 
        $('#loadingChart').fadeIn(300);
        
        var postData = { filter: selectedFilter };
        postData[csrfName] = csrfHash;

        $.ajax({
            url: "<?php echo base_url('dashboard/update_grafik'); ?>",
            type: "POST",
            dataType: "json",
            data: postData,
            success: function(response) {
                csrfHash = response.csrf_token;

                // Cek data kosong
                if (response.status === 'empty' || response.values.length === 0) {
                    chart.updateOptions({ xaxis: { categories: [] } });
                    chart.updateSeries([{ data: [] }]);
                } else {
                    // Update grafik (Animasi otomatis jalan karena config di atas)
                    chart.updateOptions({
                        xaxis: { categories: response.labels }
                    });
                    chart.updateSeries([{ data: response.values }]);
                }

                // --- KEMBALIKAN TAMPILAN (FADE IN) ---
                // Beri sedikit delay agar animasi chart terlihat enak
                setTimeout(function() {
                    $('#loadingChart').hide();
                    $('#grafikPengunjungKabupaten').fadeTo(300, 1);
                }, 300);
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                alert("Gagal memuat data.");
                $('#loadingChart').hide();
                $('#grafikPengunjungKabupaten').fadeTo(300, 1);
            }
        });
    });

  });
</script>