<section id="match-detail" class="match-detail">
  <div class="container">
    <div class="section-title">
      <span>Match Detail</span>
      <h2>Match Detail</h2>
    </div>

    <div class="row match-detail-container">
      <?php
      // Memeriksa apakah parameter matchId telah diberikan
      if (isset($_GET['id_pertandingan'])) {
        $id_pertandingan = $_GET['id_pertandingan'];

        include "proses/connect.php";

        $query = "SELECT * FROM pertandingan WHERE id_pertandingan = $id_pertandingan";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();
          ?>
          <div class="col-md-12 match-detail-item">
            <div class="card position-relative">
              <img src="admin/assets/img/<?php echo $row["gambar_pertandingan"] ?>" class="card-img-top" alt="Gambar Pertandingan">
              <div class="card-body">
                <h3 class="card-title" style="margin-top: 20px"><?php echo $row["kompetisi"] ?> MATCH ANTARA <?php echo $row["club_1"] ?> vs <?php echo $row["club_2"] ?></h3>
                <h6 class="card-title">Keterangan</h6>
                <ul>
                  <li style="margin-top: 10px">
                    <p class="card-text">Tonton pertandingan <?php echo $row["club_1"] ?> melawan <?php echo $row["club_2"] ?> di <?php echo $row["kompetisi"] ?>
                      pada <?php $tanggal = $tanggal = date('j F Y', strtotime($row["tanggal_pertandingan"])); echo strtoupper($tanggal); ?>.</p>
                  </li>

                  <li style="margin-top: 2px">Tempat: <?php echo $row["tempat_pertandingan"] ?> <?php echo $row["kota"] ?>, <?php echo $row["provinsi"] ?>.</li>
                  <li>
                    <p class="card-text">Kick Off dimulai pukul <?php echo date('H:i', strtotime($row["waktu"])); ?> WIB</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Paket Tiket -->
          <div class="col-md-12 match-detail-item" style="margin-top: 20px;">
            <div class="card position-relative">
              <div class="card-body">
                <h6 class="card-title">Paket Tiket</h6>
                <div class="row">
                  <?php
                  include "proses/connect.php";

                  $query = "SELECT * FROM tiket";
                  $result = $conn->query($query);

                  if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $namaPaket = $row['kategori'];
                      $hargaPaket = $row['harga'];
                      $idPertandingan = $_GET['id_pertandingan'];
                  ?>
                      <div class="col-md-12">
                        <div class="card mb-3">
                          <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                              <h5 class="card-title"><?php echo $namaPaket; ?></h5>
                              <p class="card-text">Harga: Rp. <?php echo number_format($hargaPaket, 0, ",", "."); ?>,00</p>
                              </div>
                              <?php
                                // Check ticket stock
                                $stokTiket = $row['stok'];
                                if ($stokTiket > 0) {
                                  // Ticket is available, display button
                                  ?>
                                  <a href="index.php?page=booking-ticket&id_tiket=<?php echo $row['id_tiket']; ?>&id_pertandingan=<?php echo $idPertandingan; ?>&kategori=<?php echo $namaPaket; ?>" class="btn btn-primary">Pilih Tiket</a>
                                  <?php
                                } else {
                                  // Ticket is out of stock, display disabled button
                                  ?>
                                  <button class="btn btn-secondary" disabled>Tiket Habis</button>
                                  <?php
                                }
                              ?>
                            </div>
                          </div>
                        </div>

                  <?php
                    }
                  } else {
                    echo "<li>Tidak ada paket tiket yang tersedia.</li>";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
      <?php
        } else {
          echo "<p>Detail pertandingan tidak ditemukan.</p>";
        }

        // Menutup koneksi ke database
        $conn->close();
      } else {
        echo "<p>ID pertandingan tidak diberikan.</p>";
      }
      ?>
    </div>
  </div>
</section>
