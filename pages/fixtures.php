<section id="fixtures" class="fixtures">
  <div class="container">
    <div class="section-title">
      <span>Jadwal Pertandingan</span>
      <h2>Jadwal Pertandingan</h2>
    </div>
    <?php if ($result->num_rows > 0) { ?>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="card" style="margin: 20px 0;">
          <div class="card-header">
            <span><?php echo date('l', strtotime($row["tanggal_pertandingan"])); ?></span>
            <span>|</span>
            <span><?php echo $row["kompetisi"]; ?></span>
          </div>
          <div class="card-body">
            <div class="card">
              <table>
                <tbody>
                  <tr>
                    <td class="venue" style="padding-left: 20px;"><?php echo $row["tempat_pertandingan"]; ?></td>
                    <td>
                      <div class="club-info">
                        <img src="assets/img/logo-transparant.png" alt="" style="max-width: 50px; max-height: 50px;">
                        <p><?php echo $row["club_1"]; ?></p>
                      </div>
                    </td>
                    <td>
                      <img src="assets/img/versus.png" style="max-width: 100px; max-height: 100px;">
                      <p style="margin-left: 15px;">
                        <?php
                        $tanggal = date('j F Y', strtotime($row["tanggal_pertandingan"]));
                        echo $tanggal;
                        ?>
                      </p>
                    </td>
                    <td>
                      <div class="club-info">
                        <img src="assets/img/logo-transparant.png" alt="" style="max-width: 50px; max-height: 50px;">
                        <p><?php echo $row["club_2"]; ?></p>
                      </div>
                    </td>
                  </tr>
                  <!-- Tambahkan baris data lainnya sesuai kebutuhan -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } else { ?>
      <p>Tidak ada jadwal pertandingan.</p>
    <?php } ?>
  </div>
</section>
