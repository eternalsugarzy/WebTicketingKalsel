<label class="form-label">Daftar Tiket Tersedia:</label>

<?php if (empty($daftar_tiket)): ?>
    
    <div class="alert alert-warning" role="alert">
      Maaf, harga tiket untuk objek wisata ini belum diatur.
    </div>

<?php else: ?>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Kategori Tiket</th>
                <th style="width: 120px;">Harga</th>
                <th style="width: 150px;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftar_tiket as $tiket): ?>
            <tr>
                <td class="align-middle">
                    <strong><?php echo $tiket['nama_tiket']; ?></strong>
                </td>
                <td class="align-middle">
                    <?php echo 'Rp ' . number_format($tiket['harga'], 0, ',', '.'); ?>
                </td>
                <td>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-kurang" type="button">-</button>
                        <input type="number" class="form-control text-center input-jumlah" value="0" min="0" 
                               data-id-harga="<?php echo $tiket['id_harga']; ?>"
                               data-nama-tiket="<?php echo $tiket['nama_tiket']; ?>"
                               data-harga="<?php echo $tiket['harga']; ?>">
                        <button class="btn btn-outline-secondary btn-tambah" type="button">+</button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>