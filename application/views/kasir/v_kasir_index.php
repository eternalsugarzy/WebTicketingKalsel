<style>
  .kasir-container {
    background: #f5f6fa;
    min-height: 100vh;
    padding: 2rem 0;
  }
  
  .kasir-header {
    background: white;
    border-radius: 8px;
    padding: 1.5rem 2rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e5e7eb;
  }
  
  .kasir-header h2 {
    color: #1f2937;
    font-weight: 500;
    margin: 0;
    font-size: 1.5rem;
  }
  
  .kasir-header p {
    color: #6b7280;
    font-size: 0.9rem;
    margin: 0.25rem 0 0 0;
  }
  
  .kasir-card {
    background: white;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    overflow: hidden;
  }
  
  .kasir-card-header {
    background: #fafafa;
    border-bottom: 1px solid #e5e7eb;
    padding: 1rem 1.5rem;
  }
  
  .kasir-card-header h5 {
    margin: 0;
    font-weight: 500;
    font-size: 1rem;
    color: #1f2937;
  }
  
  .kasir-card-body {
    padding: 1.5rem;
  }
  
  .objek-select-wrapper label {
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
  }
  
  .tiket-item {
    background: #fafafa;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 1.25rem;
    margin-bottom: 0.75rem;
    transition: border-color 0.2s;
  }
  
  .tiket-item:hover {
    border-color: #3b82f6;
  }
  
  .tiket-nama {
    font-size: 0.95rem;
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 0.35rem;
  }
  
  .tiket-harga {
    font-size: 1.1rem;
    font-weight: 600;
    color: #3b82f6;
    margin-bottom: 0.75rem;
  }
  
  .quantity-control {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: center;
  }
  
  .quantity-btn {
    width: 36px;
    height: 36px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background: white;
    color: #6b7280;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
  }
  
  .quantity-btn:hover {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
  }
  
  .quantity-input {
    width: 60px;
    height: 36px;
    text-align: center;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 0.95rem;
    font-weight: 500;
    color: #1f2937;
  }
  
  .quantity-input:focus {
    outline: none;
    border-color: #3b82f6;
  }
  
  .keranjang-item {
    background: #fafafa;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 0.875rem;
    margin-bottom: 0.625rem;
  }
  
  .keranjang-nama {
    font-weight: 500;
    color: #1f2937;
    font-size: 0.9rem;
  }
  
  .keranjang-detail {
    color: #6b7280;
    font-size: 0.825rem;
    margin-top: 0.2rem;
  }
  
  .keranjang-harga {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.95rem;
  }
  
  .total-section {
    background: #1f2937;
    color: white;
    padding: 1.25rem;
    border-radius: 6px;
    margin-top: 1rem;
  }
  
  .total-label {
    font-size: 0.9rem;
    font-weight: 400;
    opacity: 0.9;
  }
  
  .total-amount {
    font-size: 1.75rem;
    font-weight: 600;
  }
  
  .btn-proses {
    background: #3b82f6;
    border: none;
    border-radius: 6px;
    padding: 0.875rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 500;
    transition: background 0.2s;
  }
  
  .btn-proses:hover:not(:disabled) {
    background: #2563eb;
  }
  
  .btn-proses:disabled {
    background: #d1d5db;
    cursor: not-allowed;
  }
  
  .empty-state {
    text-align: center;
    padding: 2.5rem 1rem;
    color: #9ca3af;
  }
  
  .empty-state i {
    font-size: 2.5rem;
    color: #d1d5db;
    margin-bottom: 0.75rem;
  }
  
  .empty-state p {
    font-size: 0.875rem;
    margin: 0;
  }
  
  .divider {
    height: 1px;
    background: #e5e7eb;
    margin: 1.25rem 0;
  }
  
  .payment-input-group {
    margin-top: 1rem;
  }
  
  .payment-input-group label {
    font-weight: 500;
    color: #374151;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }
  
  .payment-input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 500;
    transition: border-color 0.2s;
  }
  
  .payment-input:focus {
    outline: none;
    border-color: #3b82f6;
  }
  
  .change-section {
    background: #f0fdf4;
    border: 1px solid #86efac;
    color: #166534;
    padding: 1rem;
    border-radius: 6px;
    margin-top: 0.75rem;
  }
  
  .change-label {
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
  }
  
  .change-amount {
    font-size: 1.5rem;
    font-weight: 600;
  }
  
  .shortcut-buttons {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem;
    flex-wrap: wrap;
  }
  
  .shortcut-btn {
    padding: 0.5rem 0.75rem;
    border: 1px solid #d1d5db;
    background: white;
    border-radius: 6px;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.2s;
  }
  
  .shortcut-btn:hover {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
  }

</style>

<div class="pc-container kasir-container">
  <div class="pc-content">
    <div class="kasir-header">
      <h2>Kasir Penjualan Tiket</h2>
      <p>Kelola penjualan tiket wisata</p>
    </div>
    
    <form id="form_kasir" method="POST">
      <div class="row g-3">
        <!-- Kolom Pilih Tiket -->
        <div class="col-lg-7">
          <div class="card kasir-card">
            <div class="card-header kasir-card-header">
              <h5>Pilih Tiket</h5>
            </div>
            <div class="card-body kasir-card-body">
              
              <div class="objek-select-wrapper mb-4">
                <label for="id_objek" class="form-label">
                  Objek Wisata
                </label>
                <select class="form-select" id="id_objek" name="id_objek" required>
                  <option value="">Pilih objek wisata</option>
                  <?php foreach ($objek_wisata as $objek) : ?>
                    <option value="<?php echo $objek['id_objek']; ?>">
                      <?php echo $objek['nama_objek']; ?> (<?php echo $objek['nama_kabupaten']; ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              
              <div class="divider"></div>

              <div id="area_daftar_tiket">
                <div class="empty-state">
                  <i class="fas fa-ticket-alt"></i>
                  <p>Pilih objek wisata untuk melihat daftar tiket</p>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- Kolom Detail Pembayaran -->
        <div class="col-lg-5">
          <div class="card kasir-card sticky-top" style="top: 20px;">
            <div class="card-header kasir-card-header">
              <h5>Ringkasan Pesanan</h5>
            </div>
            <div class="card-body kasir-card-body">
              
              <div id="keranjang_belanja">
                <div class="empty-state">
                  <i class="fas fa-shopping-cart"></i>
                  <p>Belum ada tiket dipilih</p>
                </div>
              </div>
              
              <div class="divider"></div>
              
              <div class="total-section">
                <div class="d-flex justify-content-between align-items-center">
                  <span class="total-label">Total</span>
                  <span class="total-amount" id="display_total_harga">Rp 0</span>
                </div>
              </div>

              <div class="payment-input-group">
                <label for="uang_dibayar">Uang Dibayar</label>
                <input type="text" 
                       class="form-control payment-input" 
                       id="uang_dibayar" 
                       placeholder="Masukkan nominal uang"
                       disabled>
                <div class="shortcut-buttons">
                  <button type="button" class="shortcut-btn" data-value="20000">20K</button>
                  <button type="button" class="shortcut-btn" data-value="50000">50K</button>
                  <button type="button" class="shortcut-btn" data-value="100000">100K</button>
                  <button type="button" class="shortcut-btn" data-value="pas">Uang Pas</button>
                </div>
              </div>

              <div class="change-section" id="change_section" style="display: none;">
                <div class="change-label">Kembalian</div>
                <div class="change-amount" id="display_kembalian">Rp 0</div>
              </div>

              <div class="d-grid mt-3">
                <button type="submit" id="btn_proses" class="btn btn-primary btn-lg btn-proses" disabled>
                  Proses & Cetak Tiket
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>