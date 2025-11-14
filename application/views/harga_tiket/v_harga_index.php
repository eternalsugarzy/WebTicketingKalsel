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
            <form action="<?php echo base_url('harga_tiket'); ?>" method="GET">
              <div class="row g-3 align-items-end">
                
                <div class="col-md-4">
                  <label class="form-label">Cari Nama Objek Wisata</label>
                  <input type="text" name="search_query" class="form-control" 
                         placeholder="Masukkan nama objek..." 
                         value="<?php echo html_escape($current_search); ?>">
                </div>
                
                <div class="col-md-3">
                  <label class="form-label">Filter per Objek Wisata</label>
                  <select name="filter_objek" id="id_objek_filter">
                    <option value="">Semua Objek</option>
                    <?php foreach ($objek_list as $obj) : ?>
                      <option value="<?php echo $obj['id_objek']; ?>" 
                              <?php echo ($obj['id_objek'] == $selected_objek) ? 'selected' : ''; ?>>
                        <?php echo html_escape($obj['nama_objek']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Filter per Kategori Tiket</label>
                  <select name="filter_kategori" id="id_kategori_filter">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($kategori_list as $kat) : ?>
                      <option value="<?php echo $kat['id_jenis_tiket']; ?>" 
                              <?php echo ($kat['id_jenis_tiket'] == $selected_kategori) ? 'selected' : ''; ?>>
                        <?php echo html_escape($kat['nama_tiket']); ?>
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
            <h5>Daftar Harga Tiket</h5>
            <div class="card-header-right">
              <a href="<?php echo base_url('harga_tiket/tambah'); ?>" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Atur Harga Baru
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Objek Wisata</th>
                    <th>Kategori Tiket</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($daftar_harga as $harga) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $harga['nama_objek']; ?></td>
                    <td><?php echo $harga['nama_tiket']; ?></td>
                    <td><?php echo 'Rp ' . number_format($harga['harga'], 0, ',', '.'); ?></td>
                    <td>
                      <a href="<?php echo base_url('harga_tiket/edit/' . $harga['id_harga']); ?>" class="btn btn-warning btn-sm"> <i class="ti ti-edit"></i>
                      </a>
                      <button type="button" class="btn btn-danger btn-sm btn-hapus" 
                              data-url="<?php echo base_url('harga_tiket/hapus/' . $harga['id_harga']); ?>"> <i class="ti ti-trash" style="font-size: 0.9rem;"></i>
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