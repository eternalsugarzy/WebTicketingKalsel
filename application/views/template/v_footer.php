<footer class="pc-footer" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
  <div class="footer-wrapper container-fluid">
    <div class="row">
      <div class="col-sm my-1">
        <p class="m-0 text-muted">© Muhammad Irwan Firmanto | 2025</p>
      </div>
    </div>
  </div>
</footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="<?php echo base_url('assets/js/plugins/apexcharts.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/simplebar.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/fonts/custom-font.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/pcoded.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/feather.min.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

  <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

  <script>
    function handlewindowload() {
      // Script Preloader (Tetap)
      if (document.getElementById('main-font-link')) {
        document.getElementById('main-font-link').onload = function () {
          setTimeout(() => {
            if (document.querySelector('.loader-bg')) {
              document.querySelector('.loader-bg').remove();
            }
          }, 100);
        };
      } else {
        setTimeout(() => {
          if (document.querySelector('.loader-bg')) {
            document.querySelector('.loader-bg').remove();
          }
        }, 100);
      }
    }
    window.addEventListener("load", handlewindowload);
    
    // ... (Kode layout nonaktif Anda) ...
  </script>

  <script>
    <?php if ($this->session->flashdata('sukses')): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?php echo $this->session->flashdata('sukses'); ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php elseif ($this->session->flashdata('error')): ?>
        Swal.fire({
            title: 'Gagal!',
            text: '<?php echo $this->session->flashdata('error'); ?>',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>

    document.addEventListener('click', function(e) {
      const deleteButton = e.target.closest('.btn-hapus');
      if (deleteButton) {
        e.preventDefault(); 
        const deleteUrl = deleteButton.getAttribute('data-url'); 
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang sudah dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      
      let keranjang = {}; 
      var tomSelectObjek; 

      function formatRupiah(angka) {
        return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      }

      function updateKeranjang() {
        let totalHarga = 0;
        let totalJumlah = 0; 
        let htmlKeranjang = '';

        for (const id_harga in keranjang) {
          const item = keranjang[id_harga];
          if (item.jumlah > 0) {
            const subtotal = item.harga * item.jumlah;
            totalHarga += subtotal;
            totalJumlah += item.jumlah; 

            htmlKeranjang += `
              <div class="mb-2">
                <strong>${item.nama}</strong>
                <span class="float-end">${formatRupiah(subtotal)}</span>
                <small class="d-block text-muted">
                  ${item.jumlah} x ${formatRupiah(item.harga)}
                </small>
                <input type="hidden" name="tiket[${id_harga}][jumlah]" value="${item.jumlah}">
                <input type="hidden" name="tiket[${id_harga}][harga]" value="${item.harga}">
              </div>
            `;
          }
        }

        if (totalJumlah > 0) {
          $("#keranjang_belanja").html(htmlKeranjang);
          $("#btn_proses").prop('disabled', false); 
        } else {
          $("#keranjang_belanja").html('<p class="text-muted text-center">Belum ada tiket yang dipilih.</p>');
          $("#btn_proses").prop('disabled', true); 
        }

        $("#display_total_harga").text(formatRupiah(totalHarga));
      }

      // --- Inisialisasi TomSelect (Tetap) ---
      const tomSelectSettings = {
          create: false,
          sortField: { field: "text", direction: "asc" }
      };
      if ($('#id_kabupaten_filter').length) {
        new TomSelect("#id_kabupaten_filter", tomSelectSettings);
      }
      if ($('#id_kabupaten').length) {
        new TomSelect("#id_kabupaten", tomSelectSettings);
      }
      if ($('#id_jenis_tiket').length) {
        new TomSelect("#id_jenis_tiket", tomSelectSettings);
      }
      if ($('#id_kategori_filter').length) {
        new TomSelect("#id_kategori_filter", tomSelectSettings);
      }
      if ($('#id_objek_filter').length) { 
        new TomSelect("#id_objek_filter", tomSelectSettings);
      }

      if ($('#table-pengunjung').length) {
    // Inisialisasi simple-datatables atau DataTables (tergantung library yg ada di template Anda)
    // Contoh simpel:
    new simpleDatatables.DataTable("#table-pengunjung");
}
      

      // --- AJAX Kasir (Load Tiket) (Tetap) ---

      
      // 1. Inisialisasi TomSelect untuk SEMUA dropdown #id_objek (jika ada)
      //    (Ini akan berfungsi di halaman 'Atur Harga' DAN 'Kasir')
      if ($('#id_objek').length) {
        tomSelectObjek = new TomSelect("#id_objek", tomSelectSettings);
      }
      
      // 2. Logika AJAX Kasir HANYA dijalankan jika #area_daftar_tiket ada
      //    (Ini HANYA akan berjalan di halaman 'Kasir')
      if ($('#area_daftar_tiket').length && tomSelectObjek) { 
        tomSelectObjek.on('change', function(id_objek_terpilih) {
          
          keranjang = {};
          updateKeranjang(); 
          
          if (id_objek_terpilih) {
            $("#area_daftar_tiket").html('<p class="text-muted text-center">Memuat harga tiket...</p>');
            $.ajax({
              url: "<?php echo base_url('kasir/get_tiket_by_objek'); ?>",
              type: "POST",
              data: { 
                id_objek: id_objek_terpilih,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
              },
              success: function(response) {
                $("#area_daftar_tiket").html(response);
              },
              error: function() {
                $("#area_daftar_tiket").html('<p class="text-danger text-center">Gagal memuat data. Coba lagi.</p>');
              }
            });
          } else {
            $("#area_daftar_tiket").html('<p class="text-muted text-center">Silakan pilih Objek Wisata terlebih dahulu...</p>');
          }
        });
      }
      // --- [AKHIR PERBAIKAN LOGIKA] ---

      // --- Event Listener Tombol + / - (Tetap) ---
      $(document).on('click', '.btn-tambah', function() {
        const input = $(this).siblings('.input-jumlah');
        let jumlah = parseInt(input.val());
        jumlah++;
        input.val(jumlah);
        const id_harga = input.data('id-harga');
        keranjang[id_harga] = {
          nama: input.data('nama-tiket'),
          harga: input.data('harga'),
          jumlah: jumlah
        };
        updateKeranjang();
      });

      $(document).on('click', '.btn-kurang', function() {
        const input = $(this).siblings('.input-jumlah');
        let jumlah = parseInt(input.val());
        if (jumlah > 0) {
          jumlah--;
          input.val(jumlah);
          const id_harga = input.data('id-harga');
          keranjang[id_harga] = {
            nama: input.data('nama-tiket'),
            harga: input.data('harga'),
            jumlah: jumlah
          };
          updateKeranjang();
        }
      });

      $(document).on('change', '.input-jumlah', function() {
        const input = $(this);
        let jumlah = parseInt(input.val());
        if (jumlah < 0 || isNaN(jumlah)) {
          jumlah = 0;
          input.val(0);
        }
        const id_harga = input.data('id-harga');
        keranjang[id_harga] = {
          nama: input.data('nama-tiket'),
          harga: input.data('harga'),
          jumlah: jumlah
        };
        updateKeranjang();
      });

      // --- Submit Form Kasir (Tetap) ---
      $("#form_kasir").on('submit', function(e) {
        e.preventDefault(); 
        const btnProses = $("#btn_proses");
        btnProses.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Memproses...');
        $.ajax({
          url: "<?php echo base_url('kasir/proses_transaksi'); ?>",
          type: "POST",
          data: $(this).serialize() + "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
          dataType: "json", 
          success: function(response) {
            if (response.status === 'sukses') {
              Swal.fire({
                title: 'Transaksi Berhasil!',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
              });
              window.open("<?php echo base_url('kasir/cetak_struk/'); ?>" + response.id_transaksi, '_blank');
              keranjang = {};
              updateKeranjang();
              if (tomSelectObjek) {
                tomSelectObjek.clear(); 
              }
              $("#area_daftar_tiket").html('<p class="text-muted text-center">Silakan pilih Objek Wisata...</p>');
            } else {
              Swal.fire('Gagal!', response.message, 'error');
            }
            btnProses.prop('disabled', false).html('Proses & Cetak Tiket');
          },
          error: function() {
            Swal.fire('Error!', 'Tidak dapat terhubung ke server.', 'error');
            btnProses.prop('disabled', false).html('Proses & Cetak Tiket');
          }
        });
      });

    });
  </script>

  <script>
    // Cek apakah kita berada di halaman validasi (ada div #qr-reader)
    if (document.getElementById('qr-reader')) {
      
      var html5QrcodeScanner; // Definisikan di scope atas
      var scanSedangDiproses = false; // Flag untuk mencegah scan ganda

      // Fungsi ini dipanggil jika scan berhasil (dari KAMERA atau FILE)
      function onScanSuccess(decodedText, decodedResult) {
        
        // Cek apakah scan sebelumnya masih diproses
        if (scanSedangDiproses) {
          return; // Abaikan scan ini
        }
        scanSedangDiproses = true; // Kunci proses scan

        console.log(`Scan berhasil: ${decodedText}`);

        // 1. Tampilkan loading di area hasil
        $("#area_hasil_scan").html('<p class="text-muted text-center">Mengecek kode...</p>');
        
        // 2. PAUSE scanner (lebih aman dari stop/clear)
        // Kita gunakan try-catch untuk jaga-jaga jika ini scan dari file
        try {
           if (html5QrcodeScanner.getState() === Html5QrcodeScannerState.SCANNING) {
             html5QrcodeScanner.pause();
           }
        } catch (e) {
           console.warn("Gagal pause, mungkin ini file scan.", e);
        }

        // 3. Kirim kode ke server (Controller Validasi) via AJAX
        $.ajax({
            url: "<?php echo base_url('validasi/cek_kode'); ?>",
            type: "POST",
            data: { 
              kode_tiket: decodedText,
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            success: function(response) {
              // 4. Tampilkan hasil dari server
              let resultHtml = '';
              if (response.status === 'sukses') {
                resultHtml = `<div class="alert alert-success">
                                <h4>${response.message}</h4>
                                <p>Objek Wisata: <strong>${response.data.nama_objek}</strong></p>
                                <p>Jumlah Pengunjung: <strong>${response.data.total_pengunjung} Orang</strong></p>
                              </div>`;
              } else if (response.status === 'warning') {
                resultHtml = `<div class="alert alert-warning">
                                <h4>${response.message}</h4>
                                <p>Objek Wisata: <strong>${response.data.nama_objek}</strong></p>
                                <p>Jumlah Pengunjung: <strong>${response.data.total_pengunjung} Orang</strong></p>
                              </div>`;
              } else {
                resultHtml = `<div class="alert alert-danger">
                                <h4>${response.message}</h4>
                              </div>`;
              }
              $("#area_hasil_scan").html(resultHtml);

              // 5. Lanjutkan scan setelah 3 detik
              setTimeout(() => {
                try {
                  if (html5QrcodeScanner.getState() === Html5QrcodeScannerState.PAUSED) {
                    html5QrcodeScanner.resume();
                  }
                } catch (e) {
                   console.warn("Gagal resume scanner.", e);
                   // Jika gagal, mungkin file scan, reset saja teksnya
                   $("#area_hasil_scan").html('<p class="text-muted text-center">Silakan scan lagi...</p>');
                }
                
                // Reset teks di area hasil jika kamera masih PAUSED
                if (html5QrcodeScanner.getState() === Html5QrcodeScannerState.PAUSED) {
                    $("#area_hasil_scan").html('<p class="text-muted text-center">Arahkan kamera ke QR Code...</p>');
                }
                
                scanSedangDiproses = false; // Buka kunci
              }, 3000); // 3 detik
            },
            error: function() {
              $("#area_hasil_scan").html('<p class="text-danger text-center">Error koneksi ke server.</p>');
              scanSedangDiproses = false; // Buka kunci
            }
        });
      }

      // Fungsi ini dipanggil jika scan gagal (bisa diabaikan)
      function onScanFailure(error) {
        // console.warn(`Scan gagal, error = ${error}`);
      }

      // 5. Buat objek scanner baru
      html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", // ID div tempat kamera
        { 
          fps: 10, // Frames per second
          qrbox: { width: 250, height: 250 }, // Ukuran kotak scan
          rememberLastUsedCamera: true // Ingat kamera terakhir
        },
        /* verbose= */ false);
      
      // 6. Langsung render scanner saat halaman dimuat
      // Ini akan membuat UI lengkap (start/stop/upload)
      html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    }
  </script>

  </body>
</html>