<?php if (empty($daftar_tiket)): ?>
    
    <div class="alert alert-warning border-0" role="alert" style="border-radius: 6px; border-left: 3px solid #f59e0b; background: #fef3c7; color: #92400e;">
      <strong>Perhatian:</strong> Harga tiket untuk objek wisata ini belum diatur.
    </div>

<?php else: ?>
    
    <div class="tiket-list">
        <?php foreach ($daftar_tiket as $tiket): ?>
        <div class="tiket-item">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="tiket-nama">
                        <?php echo $tiket['nama_tiket']; ?>
                    </div>
                    <div class="tiket-harga">
                        <?php echo 'Rp ' . number_format($tiket['harga'], 0, ',', '.'); ?>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="quantity-control">
                        <button class="quantity-btn btn-kurang" type="button">
                            −
                        </button>
                        <input type="number" class="form-control quantity-input input-jumlah" value="0" min="0" 
                               data-id-harga="<?php echo $tiket['id_harga']; ?>"
                               data-nama-tiket="<?php echo $tiket['nama_tiket']; ?>"
                               data-harga="<?php echo $tiket['harga']; ?>"
                               readonly>
                        <button class="quantity-btn btn-tambah" type="button">
                            +
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>