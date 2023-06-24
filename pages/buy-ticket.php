<?php
// Memeriksa apakah parameter id_tiket dan id_pertandingan telah diberikan
if (isset($_GET['id_tiket']) && isset($_GET['id_pertandingan']) && isset($_GET['kategori'])) {
    $id_tiket = $_GET['id_tiket'];
    $id_pertandingan = $_GET['id_pertandingan'];
    $kategori = $_GET['kategori'];

    // TODO: Ambil informasi tiket dari database berdasarkan id_tiket
    include "proses/connect.php";

    $query = "SELECT * FROM pembelian_tiket p, tiket t WHERE p.id_tiket = '$id_tiket' AND p.id_pertandingan = '$id_pertandingan' AND p.kategori = '$kategori' AND p.id_tiket = t.id_tiket";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $orderid = $row['orderid'];       
        $stokTiket = $row['stok'];
        $hargaSatuan = $row['harga'];
    } else {
        echo "<p>Detail tiket tidak ditemukan.</p>";
        exit;
    }

    // Menutup koneksi ke database
    $conn->close();

    // Contoh tampilan pembelian tiket
    ?>
    <section id="buy-ticket" class="buy-ticket">
        <div class="container">
            <div class="section-title">
                <span>Pembelian Tiket</span>
                <h2>Pembelian Tiket</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if ($stokTiket > 0) {
                                include "proses/connect.php";

                                $query = "SELECT * FROM pertandingan WHERE id_pertandingan = '$id_pertandingan'";
                                $result = $conn->query($query);

                                if ($result && $result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card" style="margin: 10px;  background-color:#0E1E36; ">
                                                <h5 for="tanggal" style="margin-top: 30px; margin-left: 60px; color : #ffffff;">Paket yang dipilih</h3>
                                                <div class="card-body text-center" style="display: flex; justify-content: center; align-items: left; height: 100%;">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <div class="card" style="margin-bottom: 10px; width: 22rem; justify-content: left;border: 2px solid transparent; border-color: var(--color-B400);">
                                                                <div class="card-body">
                                                                    <h5 class="card-title" style="margin-top: 20px; text-align: left;"><?php echo $kategori; ?></h6>
                                                                    <h5 class="card-title text-left" style="margin-top: 10px; text-align: left; color: red; position: relative;"><?php echo 'Rp. ' . number_format($hargaSatuan, 0, ',', '.'); ?><span style="position: absolute; bottom: -10px; left: 0; width: 100%; height: 1px; background-color: black; opacity: 0.6;"></span></h5>
                                                                    <p class="card-title" style="opacity: 0.6; margin-top: 20px; text-align: left;">Tiket ini untuk match <?php echo $row["club_1"]; ?> vs <?php echo $row["club_2"]; ?></p>

                                                                    <h6 class="card-title" style="text-align: left;">Keterangan :</h6>
                                                                    <ul style="margin-bottom: 50px ">
                                                                        <li style="margin-top: 5px ">
                                                                            <p class="card-text" style="text-align: left;">pertandingan <?php echo $row["club_1"]; ?> melawan <?php echo $row["club_2"]; ?> pada <?php $tanggal = $tanggal = date('j F Y', strtotime($row["tanggal_pertandingan"])); echo strtoupper($tanggal); ?>.</p>
                                                                        </li>

                                                                        <li style="margin-top: 2px ">
                                                                            <p style="text-align: left;">Tempat: <?php echo $row["tempat_pertandingan"]; ?> <?php echo $row["kota"]; ?>, <?php echo $row["provinsi"]; ?>.</p>
                                                                        </li>
                                                                        <li style="margin-top: 2px ">
                                                                            <p class="card-text" style="text-align: left;">Kick Off dimulai pukul <?php echo date('H:i', strtotime($row["waktu"])); ?> WIB.</p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <form action="proses/buy.php" method="GET" id="form-pembelian">
                                                <input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
                                               

                                                <div class="card" style="margin: 10px;">
                                                    <div class="card-header">
                                                        <h5 class="card-title">Form Pembelian</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group" style="margin-top: 10px;">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama" required>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 10px;">
                                                            <label for="email">Email</label>
                                                            <input type="email" placeholder="Masukkan Email" class="form-control" id="email" name="email" required>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 10px;">
                                                            <label for="nohp">No. HP</label>
                                                            <input type="tel" placeholder="Masukkan No. HP" class="form-control" id="nohp" name="nohp" required>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer d-flex justify-content-center" style="margin-top: 90px;">
                                                        <button type="submit" class="btn btn-primary">Pesan Tiket</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                            $conn->close();
                            } else {
                            ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <p>Stok tiket habis.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
    echo "<p>ID tiket dan ID pertandingan tidak diberikan.</p>";
}
?>
