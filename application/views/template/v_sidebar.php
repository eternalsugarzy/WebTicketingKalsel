<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    
    <div class="m-header" style="display: flex; justify-content: center; align-items: center;"> 
      <a href="<?php echo base_url('dashboard'); ?>" class="b-brand text-primary">
        <img src="<?php echo base_url('assets/img/logo.png'); ?>" class="img-fluid logo-lg" alt="logo" style="height: 55px;"> 
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Navigasi</label>
        </li>
        
        <li class="pc-item <?php echo ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'active' : ''; ?>">
          <a href="<?php echo base_url('dashboard'); ?>" class="pc-link">
            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>

        <?php if ($this->session->userdata('level') == 'Admin'): ?>
          <li class="pc-item pc-caption">
            <label>Data Master</label>
          </li>
          <li class="pc-item <?php echo ($this->uri->segment(1) == 'user') ? 'active' : ''; ?>">
            <a href="<?php echo base_url('user'); ?>" class="pc-link">
              <span class="pc-micon"><i class="ti ti-users"></i></span>
              <span class="pc-mtext">Manajemen User</span>
            </a>
          </li>
          <li class="pc-item <?php echo ($this->uri->segment(1) == 'objek_wisata') ? 'active' : ''; ?>">
            <a href="<?php echo base_url('objek_wisata'); ?>" class="pc-link">
              <span class="pc-micon"><i class="ti ti-map-pin"></i></span>
              <span class="pc-mtext">Objek Wisata</span>
            </a>
          </li>
          <li class="pc-item <?php echo ($this->uri->segment(1) == 'jenis_tiket') ? 'active' : ''; ?>">
            <a href="<?php echo base_url('jenis_tiket'); ?>" class="pc-link">
              <span class="pc-micon"><i class="ti ti-ticket"></i></span>
              <span class="pc-mtext">Jenis Tiket</span>
            </a>
          </li>
          <li class="pc-item <?php echo ($this->uri->segment(1) == 'harga_tiket') ? 'active' : ''; ?>">
            <a href="<?php echo base_url('harga_tiket'); ?>" class="pc-link">
              <span class="pc-micon"><i class="ti ti-tag"></i></span>
              <span class="pc-mtext">Manajemen Harga</span>
            </a>
          </li>

          <li class="pc-item">
  <a href="<?php echo base_url('pengunjung'); ?>" class="pc-link">
    <span class="pc-micon"><i class="ti ti-chart-pie-2"></i></span>
    <span class="pc-mtext">Data Pengunjung</span>
  </a>
</li>
        <?php endif; ?>
        <li class="pc-item pc-caption">
          <label>Transaksi</label>
        </li>
        
        <?php if ($this->session->userdata('level') == 'Admin' || $this->session->userdata('level') == 'Kasir'): ?>
          <li class="pc-item <?php echo ($this->uri->segment(1) == 'kasir') ? 'active' : ''; ?>">
            <a href="<?php echo base_url('kasir'); ?>" class="pc-link">
              <span class="pc-micon"><i class="ti ti-businessplan"></i></span>
              <span class="pc-mtext">Kasir Penjualan</span>
            </a>
          </li>
        <?php endif; ?>
        
        <?php if ($this->session->userdata('level') == 'Admin' || $this->session->userdata('level') == 'Kasir' || $this->session->userdata('level') == 'Petugas'): ?>
          <li class="pc-item <?php echo ($this->uri->segment(1) == 'validasi') ? 'active' : ''; ?>">
            <a href="<?php echo base_url('validasi'); ?>" class="pc-link">
              <span class="pc-micon"><i class="ti ti-qrcode"></i></span>
              <span class="pc-mtext">Validasi Tiket</span>
            </a>
          </li>
        <?php endif; ?>
        
        
        <?php if ($this->session->userdata('level') == 'Admin'): ?>
          <li class="pc-item pc-caption">
            <label>Laporan</label>
          </li>
          <li class="pc-item pc-hasmenu <?php echo ($this->uri->segment(1) == 'laporan') ? 'pc-trigger' : ''; ?>">
            <a href="#!" class="pc-link">
              <span class="pc-micon"><i class="ti ti-file-analytics"></i></span>
              <span class="pc-mtext">Semua Laporan</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
              <li class="pc-item <?php echo ($this->uri->segment(2) == 'penjualan') ? 'active' : ''; ?>">
                <a class="pc-link" href="<?php echo base_url('laporan/penjualan'); ?>">Laporan Penjualan (Detail)</a>
              </li>
              <li class="pc-item <?php echo ($this->uri->segment(2) == 'penjualan_ringkas') ? 'active' : ''; ?>">
                <a class="pc-link" href="<?php echo base_url('laporan/penjualan_ringkas'); ?>">Laporan Ringkas (Harian)</a>
              </li>
              <li class="pc-item <?php echo ($this->uri->segment(2) == 'kunjungan') ? 'active' : ''; ?>">
                <a class="pc-link" href="<?php echo base_url('laporan/kunjungan'); ?>">Laporan Kunjungan (Scan)</a>
              </li>
              <li class="pc-item <?php echo ($this->uri->segment(2) == 'rekap_objek') ? 'active' : ''; ?>">
                <a class="pc-link" href="<?php echo base_url('laporan/rekap_objek'); ?>">Laporan Rekapitulasi</a>
              </li>
              <li class="pc-item <?php echo ($this->uri->segment(2) == 'data_master') ? 'active' : ''; ?>">
                <a class="pc-link" href="<?php echo base_url('laporan/data_master'); ?>">Laporan Data Master</a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        </ul>
    </div>
  </div>
</nav>
<header class="pc-header">
  <div class="header-wrapper"> 
    
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <li class="pc-h-item pc-sidebar-collapse">
          <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
          <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
      </ul>
    </div>
    
    <div class="ms-auto">
      <ul class="list-unstyled">
        
        <li class="dropdown pc-h-item header-user-profile">
          <a
            class="pc-head-link dropdown-toggle arrow-none me-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            data-bs-auto-close="outside"
            aria-expanded="false"
          >
            <i class="ti ti-user me-2"></i>
            <span><?php echo $this->session->userdata('nama'); ?></span>
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown" >
            <div class="dropdown-header">
              <div class="d-flex mb-1">
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1"><?php echo $this->session->userdata('nama'); ?></h6>
                  <span><?php echo $this->session->userdata('level'); ?></span>
                </div>
                <a href="<?php echo base_url('auth/logout'); ?>" class="pc-head-link bg-transparent"><i class="ti ti-power text-danger"></i></a>
              </div>
            </div>
            
            <div class="tab-content" id="mysrpTabContent">
              <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                <a href="<?php echo base_url('auth/logout'); ?>" class="dropdown-item">
                  <i class="ti ti-power"></i>
                  <span>Logout</span>
                </a>
              </div>
            </div>
          </div>
        </li>
        
      </ul>
    </div>
  </div>
</header>