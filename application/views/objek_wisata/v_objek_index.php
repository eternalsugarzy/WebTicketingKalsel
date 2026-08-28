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
            <form action="<?php echo base_url('objek_wisata'); ?>" method="GET">
              <div class="row g-3 align-items-end">
                
                <div class="col-md-5">
                  <label class="form-label">Cari Nama Objek</label>
                  <input type="text" name="search_query" class="form-control" 
                         placeholder="Masukkan nama objek..." 
                         value="<?php echo html_escape($current_search); ?>">
                </div>
                
                <div class="col-md-5">
                  <label class="form-label">Filter per Kabupaten/Kota</label>
                  <select name="filter_kabupaten" id="id_kabupaten_filter">
                    <option value="">Semua Kabupaten</option>
                    <?php foreach ($kabupaten_list as $kab) : ?>
                      <option value="<?php echo $kab['id_kabupaten']; ?>" 
                              <?php echo ($kab['id_kabupaten'] == $selected_kabupaten) ? 'selected' : ''; ?>>
                        <?php echo html_escape($kab['nama_kabupaten']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">Cari</button>
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
            <h5>Daftar Objek Wisata</h5>
            <div class="card-header-right">
              <a href="<?php echo base_url('objek_wisata/tambah'); ?>" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah Data
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="10%">Foto</th> 
                    <th width="20%">Nama Objek</th>
                    <th>Deskripsi Singkat</th> 
                    <th width="15%">Kabupaten/Kota</th>
                    <th width="15%">Alamat</th>
                    <th width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    // [MODIFIKASI] Nomor mengikuti halaman
                    $no = $start + 1; 
                  ?>
                  <?php if(empty($objek_wisata)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                  <?php else : ?>
                      <?php foreach ($objek_wisata as $objek) : ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <?php if(!empty($objek['foto'])) : ?>
                                <img src="<?php echo base_url('uploads/objek_wisata/'.$objek['foto']); ?>" 
                                     alt="Foto" style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                            <?php else: ?>
                                <span class="badge bg-secondary">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><strong><?php echo html_escape($objek['nama_objek']); ?></strong></td>
                        
                        <td>
                            <?php
                                $deskripsi = isset($objek['deskripsi']) ? $objek['deskripsi'] : '';
                                if (strlen($deskripsi) > 100) {
                                    echo html_escape(substr($deskripsi, 0, 100) . '...');
                                } else {
                                    echo html_escape($deskripsi);
                                }
                            ?>
                        </td>

                        <td><?php echo html_escape($objek['nama_kabupaten']); ?></td>
                        <td><?php echo html_escape($objek['alamat']); ?></td>
                        <td>
                          <a href="<?php echo base_url('objek_wisata/detail/' . $objek['id_objek']); ?>" class="btn btn-info btn-sm" title="Lihat Detail">
                            <i class="ti ti-eye"></i>
                          </a>

                          <a href="<?php echo base_url('objek_wisata/edit/' . $objek['id_objek']); ?>" class="btn btn-warning btn-sm" title="Edit">
                            <i class="ti ti-edit"></i>
                          </a>
                          <button type="button" class="btn btn-danger btn-sm btn-hapus" 
                                  data-url="<?php echo base_url('objek_wisata/hapus/' . $objek['id_objek']); ?>" title="Hapus">
                            <i class="ti ti-trash"></i>
                          </button>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            
            <div class="mt-3">
                <?php echo $pagination; ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>