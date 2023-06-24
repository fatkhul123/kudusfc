<?php 
        if (isset($_GET['orderid'])) {
            $orderid = $_GET['orderid']; // Menggunakan variabel $orderids
    
    include "proses/connect.php";
    date_default_timezone_set("Asia/Bangkok");

    $liatcust = mysqli_query($conn, "SELECT * FROM pengguna l, pembelian_tiket c WHERE orderid='$orderid' AND l.id_pengguna=c.id_pengguna");
    $checkdb = mysqli_fetch_array($liatcust);

    if ($checkdb) { // Memeriksa apakah data ditemukan
        if (isset($_POST['konfirmasi'])) { // Memeriksa apakah tombol "Konfirmasi" ditekan
            // Ubah status pesanan menjadi "Payment"
            $updateStatus = mysqli_query($conn, "UPDATE pembelian_tiket SET status='Selesai' WHERE orderid='$orderid'");
            
            if ($updateStatus) {
                // Status berhasil diubah
                $checkdb['status'] = 'Selesai';
            } else {
                echo '<p>Gagal mengubah status pesanan.</p>';
            }
        }
?>
    <!-- page title area end -->
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Detail Order</h3>
                    </div>
                    <div class="card-body">
                        <h5>Informasi Pesanan :</h5><br>
                        <p>
                            Kode Order: <b><?php echo $checkdb['orderid']; ?></b><br>
                            Nama Pelanggan: <b><?php echo $checkdb['nama_pengguna']; ?></b><br>
                            Waktu order: <b><?php echo date('d M Y H:i', strtotime($checkdb['tanggal_pembelian'])); ?></b><br>
                            Status Pesanan: <b><?php echo $checkdb['status']; ?></b><br>
                        </p>
                        <hr>
                        <h5>Daftar Item Pesanan :</h5><br>
                        <table id="dataTableExample" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tiket</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM pembelian_tiket d, pertandingan p, tiket t WHERE orderid = '$orderid' 
                                                AND d.id_pertandingan = p.id_pertandingan AND d.id_tiket = t.id_tiket ORDER BY d.id_pertandingan ASC");
                                while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data["kompetisi"] ?> MATCH ANTARA <?php echo $data["club_1"] ?>
                                            vs <?php echo $data["club_2"] ?><br></td>
                                        <td><?php echo $data['jumlah_tiket'] ?></td>
                                        <td><?php echo "Rp " . number_format($data['harga'], 0, ',', '.'); ?></td>
                                        <td><?php echo "Rp " . number_format($data['total_harga'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php 
                                    $no++;
                                } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
                <div class="col-md-6">
                <div class="card">
                        	<div class="card-header">
								<h3>Pembayaran</h3>
							</div>
                            <div class="card-body">
                            <h5>Informasi Pembayaran:</h5><br>
                            <?php
                            $ambilinfo = mysqli_query($conn, "SELECT * FROM pembayaran WHERE orderid = '$orderid' ORDER BY id_pembayaran DESC LIMIT 1");
                            if ($ambilinfo && mysqli_num_rows($ambilinfo) > 0) {
                                $data = mysqli_fetch_assoc($ambilinfo);
                            ?>
                                <p>
                                    Bank Tujuan: <b><?php echo $data['metode_pembayaran']; ?></b><br>
                                    Pemilik Rekening: <b><?php echo $data['nama_rekening']; ?></b><br>
                                    Tanggal Pembayaran: <b><?php echo $data['Tanggal_bayar']; ?></b><br>
                                </p>
                            <?php } else { ?>
                                <p style="text-align: center;">Pembayaran belum dilakukan</p>
                            <?php } ?>
                        </div>

                    <div class="card">
                        <div class="card-header">
                            <h3>Status</h3>
                        </div>
                        <div class="card-body">
                            <?php 
                            if ($checkdb['status'] == 'Belum Bayar') {
                            ?>
                            <?php } elseif ($checkdb['status'] == 'Waiting') {
                            ?>
                                <form method="post">
                                    <button type="submit" name="konfirmasi" class="btn btn-warning">Konfirmasi</button>
                                </form>
                            <?php } elseif ($checkdb['status'] == 'Selesai') {
                            ?>
                            <a target="_blank" href="proses/invoice.php?orderid=<?= $orderid ?>" class="btn btn-success">Cetak Invoice</a>
                            <?php } else {
                                // Tambahkan logika atau tindakan lain sesuai dengan kebutuhan Anda
                            } ?>

                        </div>

                    </div>
                </div>
        </div>
    </div>
<?php
    } else {
        echo "<p>Data pesanan tidak ditemukan.</p>";
    }
} else {
    echo "<p>ID order tidak diberikan.</p>";
}
?>
