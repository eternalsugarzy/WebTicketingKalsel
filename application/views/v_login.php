<!DOCTYPE html>
<html lang="id">
<head>
  <title>Login | Sistem Tiket Wisata Kalsel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <link rel="icon" href="<?php echo base_url('assets/img/logo.png'); ?>" type="image/png">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/tabler-icons.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/feather.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/fontawesome.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/material.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" id="main-style-link">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style-preset.css'); ?>">

  <style>
    .auth-main {
      /* 1. Background Image Anda (Tetap) */
      background-image: url('<?php echo base_url('assets/img/background1.jpg'); ?>');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }
    
    /* 2. Overlay Gelap (Tetap) */
    .auth-main::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5); 
      z-index: 1;
    }

    /* 3. Konten (Tetap) */
    .auth-wrapper {
      position: relative;
      z-index: 2;
    }

    /* [PERBAIKAN DI SINI] Menambahkan !important untuk memaksa override */
    .auth-wrapper.v3 {
      background-image: none !important;
    }
  </style>
  </head>
<body>
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        
        <div class="card my-5">
          <div class="card-body">
            
            <div class="text-center mb-3">
              <img src="<?php echo base_url('assets/img/wonderfulkalsel.png'); ?>" alt="logo" style="height: 60px;">
            </div>
            
            <h3 class="mb-4 text-center"><b>Login Sistem</b></h3>
            
            <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert" style="padding: 0.8rem 1rem; font-size: 0.9rem;">
              <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php endif; ?>

            <?php echo form_open('auth/proses_login'); ?>
              
              <div class="form-group mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control <?php echo (form_error('username') ? 'is-invalid' : ''); ?>" 
                       name="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('username'); ?>
                </div>
              </div>
              
              <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control <?php echo (form_error('password') ? 'is-invalid' : ''); ?>" 
                       name="password" placeholder="Password">
                <div class="invalid-feedback">
                  <?php echo form_error('password'); ?>
                </div>
              </div>
              
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>

            <?php echo form_close(); ?>
            
          </div>
        </div>
        <div class="auth-footer row">
            <div class="col my-1">
              <p class="m-0">Proyek PKL Tiket Wisata Kalsel</p>
            </div>
            <div class="col-auto my-1">
              
            </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url('assets/js/plugins/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/simplebar.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/fonts/custom-font.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/pcoded.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/feather.min.js'); ?>"></script>
   
</body>
</html>