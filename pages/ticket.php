<section id="match" class="match">
  <div class="container">
    <div class="section-title">
      <span>Beli Tiket</span>
      <h2>Beli Tiket</h2>
    </div>
    
    <div class="row match-container">
  <?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
  ?>
     <div class="col-md-6 match-item mb-3">
  <?php
  if (isset($_SESSION['id_pengguna'])) {
    // Pengguna sudah login
    echo '<a href="index.php?page=match-detail&id_pertandingan=' . $row['id_pertandingan'] . '" style="text-decoration: none;">';
  } else {
    // Pengguna belum login
    echo '<a href="login.php" style="text-decoration: none; pointer-events: none; cursor: default;">';
  }
  ?>
    <div class="card position-relative">
      <img src="admin/assets/img/<?php echo $row["gambar_pertandingan"] ?>" class="card-img-top" alt="Gambar Pertandingan">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row["kompetisi"] ?> MATCH ANTARA <?php echo $row["club_1"] ?> vs <?php echo $row["club_2"] ?></h5>
        <p class="card-text"><?php echo $row["tanggal_pertandingan"] ?></p>
        <p class="card-text"><?php echo $row["tempat_pertandingan"] ?></p>
        <p class="card-text">Ayo saksikan pertandingan klub kebanggaanmu!!!</p>
      </div>
    </div>
  </a>
</div>

  <?php
    }
  } else {
    echo "<p>Tidak ada jadwal pertandingan.</p>";
  }
  ?>
</div>

</section>
