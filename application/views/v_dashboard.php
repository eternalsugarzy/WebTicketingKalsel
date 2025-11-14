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
        <div class="card">
          <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Total Pengunjung (Hari Ini)</h6>
            <h4 class="mb-3"><?php echo number_format($total_hari_ini['total_tiket_terjual'] ?? 0); ?></h4>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Total Penjualan (Hari Ini)</h6>
            <h4 class="mb-3">Rp <?php echo number_format($total_hari_ini['total_pendapatan'] ?? 0, 0, ',', '.'); ?></h4>
          </div>
        </div>
      </div>
      
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5>Grafik Kunjungan per Kabupaten/Kota</h5>
            
            <div style="height: 400px;">
              <canvas id="grafikPengunjungKabupaten"></canvas>
            </div>

          </div>
        </div>
      </div>

    </div>
    </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    
    const labels = <?php echo $grafik_labels_json; ?>;
    const dataValues = <?php echo $grafik_data_json; ?>;

    const ctx = document.getElementById('grafikPengunjungKabupaten').getContext('2d');

    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Total Pengunjung',
          data: dataValues,
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false, 
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: false,
          }
        }
      }
    });

  });
</script>