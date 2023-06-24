<?php
// Memeriksa apakah parameter id_tiket dan id_pertandingan telah diberikan
if (isset($_GET['id_tiket']) && isset($_GET['id_pertandingan']) && isset($_GET['kategori'])) {
    $id_tiket = $_GET['id_tiket'];
    $id_pertandingan = $_GET['id_pertandingan'];
    $kategori = $_GET['kategori'];
    

    // TODO: Ambil informasi tiket dari database berdasarkan id_tiket
    include "proses/connect.php";

    $query = "SELECT * FROM tiket WHERE id_tiket = $id_tiket";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $kategori = $row['kategori'];
        $hargaSatuan = $row['harga'];
        $stokTiket = $row['stok']; // Added line to retrieve stock value
    } else {
        echo "<p>Detail tiket tidak ditemukan.</p>";
        exit;
    }

    // Menutup koneksi ke database

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

                                $query = "SELECT * FROM pertandingan WHERE id_pertandingan = $id_pertandingan";
                                $result = $conn->query($query);

                                if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            ?>
                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="card" style="margin: 10px;  background-color:#0E1E36; ">
                                                <h5 for="tanggal" style="margin-top: 30px; margin-left: 60px; color : #ffffff;">Paket yang dipilih</h3>
                                                <div class="card-body text-center"style="  display: flex; justify-content: center; align-items: left; height: 100%; "> <!-- Tambahkan class "text-center" di sini -->
                                                <div class="form-group">
                                                <div class="col-md-3">
                                                    <div class="card" style="margin-bottom: 10px; width: 22rem; justify-content: left;border: 2px solid transparent; border-color: var(--color-B400);">
                                                        <div class="card-body">
                                                        <h5 class="card-title"style="margin-top: 20px; text-align: left;"><?php echo $kategori; ?></h6>
                                                        <h5 class="card-title text-left" style="margin-top: 10px; text-align: left; color: red; position: relative;"><?php echo 'Rp. ' . number_format($hargaSatuan, 0, ',', '.'); ?><span style="position: absolute; bottom: -10px; left: 0; width: 100%; height: 1px; background-color: black; opacity: 0.6;"></span></h5>
                                                        <p class="card-title" style="opacity: 0.6; margin-top: 20px; text-align: left;">Tiket ini untuk match <?php echo $row["club_1"] ?> vs <?php echo $row["club_2"] ?></p>

                                                        <h6 class="card-title "style="text-align: left;">Keterangan :</h6>
                                                        <ul style="margin-bottom: 50px ">
                                                        <li style="margin-top: 5px ">
                                                            <p class="card-text"style="text-align: left;">pertandingan <?php echo $row["club_1"] ?> melawan <?php echo $row["club_2"] ?> pada <?php $tanggal = $tanggal = date('j F Y', strtotime($row["tanggal_pertandingan"])); echo strtoupper($tanggal); ?>.</p>
                                                        </li>

                                                        <li style="margin-top: 2px ">
                                                            <p style="text-align: left;">Tempat: <?php echo $row["tempat_pertandingan"] ?> <?php echo $row["kota"] ?>, <?php echo $row["provinsi"] ?>.</p>
                                                        </li>
                                                        <li margin-top: 2px >
                                                            <p class="card-text"style="text-align: left;">Kick Off dimulai pukul <?php echo date('H:i', strtotime($row["waktu"])); ?> WIB.</p>
                                                        </li>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            <?php
                                            }
                                            ?>
                                    <div class="col-md-8 ">
                                        <form action="proses/booking.php" method="GET" id="form-pembelian">
                                        <input type="hidden" name="id_tiket" value="<?php echo $id_tiket; ?>">
                                        <input type="hidden" name="id_pertandingan" value="<?php echo $id_pertandingan; ?>">
                                        <input type="hidden" name="kategori" value="<?php echo $kategori; ?>">
                                        <input type="hidden" name="harga" value="<?php echo $hargaSatuan; ?>">

                                        <div class="card"style="margin: 10px;">
                                            <div class="card-header">
                                            <label for="tanggal" style="margin: 5px;">Tanggal</label>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <input type="date" placeholder="Pilih Tanggal" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"  required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card" style="margin: 10px;">
                                            <div class="card-header">
                                                <label for="jumlah_tiket" style="margin: 5px;">Jumlah Tiket</label>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-secondary" style="margin-right: 5px;" type="button" onclick="decrement()">-</button>
                                                        </div>
                                                        <input type="text" class="form-control" id="jumlah_tiket" name="jumlah_tiket" value="1" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" style="margin-left: 5px;" type="button" onclick="increment()">+</button>
                                                        </div>
                                                    </div>
                                                    <small id="stokTiketHelp" class="form-text text-muted">Stok Tersedia: <?php echo $stokTiket; ?></small>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="card" style="margin: 10px;">
                                                <div class="card-header">
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                    <label for="tanggal" >Tanggal</label>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <p class="card-text" style="text-align: right;" id="tanggal_pembelian_text"></p>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                            <div class="form-group">
                                                            <label for="total_harga" style="margin: 5px;">Total Harga</label>
                                                            <input type="text" class="form-control" id="total_harga" name="total_harga" value="Rp. <?php echo number_format($hargaSatuan, 0, ',', '.'); ?>" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-8 text-right" style="text-align: right; margin-top: 35px;">
                                                    <button type="submit" class="btn btn-primary" style="align: right;">Pesan Tiket</button>
                                                    </div>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        
                 var jumlahTiketInput = document.getElementById('jumlah_tiket');
                var totalHargaInput = document.getElementById('total_harga');

            function increment() {
                var jumlahTiket = parseInt(jumlahTiketInput.value);
                jumlahTiket += 1;
                jumlahTiketInput.value = jumlahTiket;
                updateTotalHarga();
            }

            function decrement() {
                var jumlahTiket = parseInt(jumlahTiketInput.value);
                if (jumlahTiket > 1) {
                    jumlahTiket -= 1;
                    jumlahTiketInput.value = jumlahTiket;
                    updateTotalHarga();
                }
            }

            function updateTotalHarga() {
                var jumlahTiket = parseInt(jumlahTiketInput.value);
                var hargaSatuan = <?php echo $hargaSatuan; ?>;
                var totalHarga = jumlahTiket * hargaSatuan;
                totalHargaInput.value = 'Rp. ' + totalHarga.toLocaleString('id-ID');
            }

        // Mendapatkan tanggal hari ini
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        var todayFormatted = yyyy + '-' + mm + '-' + dd;

        // Mengatur nilai input tanggal dengan tanggal hari ini
        document.getElementById('tanggal_pembelian').value = todayFormatted;

                // Mengambil tanggal pembelian dari PHP dan mengubahnya menjadi objek Date
        var tanggalPembelian = new Date();

        // Mengatur opsi bahasa menjadi Indonesia
        var options = {  year: 'numeric', month: 'long', day: 'numeric' };

        // Memformat tanggal sesuai dengan opsi yang diberikan
        var tanggalFormatted = tanggalPembelian.toLocaleDateString('id-ID', options).replace(/^(.*), (\w+)$/, "$1, $2").toUpperCase();

        // Mengubah teks pada elemen dengan id "tanggal_pembelian_text"
        document.getElementById('tanggal_pembelian_text').textContent = tanggalFormatted;

       
    </script>
<?php
} else {
    echo "<p>ID tiket dan ID pertandingan tidak diberikan.</p>";
}
?>