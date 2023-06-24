<section id="history" class="history">
    <div class="container">
        <div class="section-title">
            <span>History Pembelian Tiket</span>
            <h2>History Pembelian Tiket</h2>
        </div>
        <?php
        if (isset($_SESSION['id_pengguna'])) {
            $id_pengguna = $_SESSION['id_pengguna'];

            // TODO: Ambil informasi tiket terbaru dari database berdasarkan id_pengguna
            include "proses/connect.php";

            $query = "SELECT * FROM pembelian_tiket WHERE id_pengguna = $id_pengguna";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { // Menggunakan fetch_assoc() untuk mengambil asosiatif array
                    $orderid = $row['orderid'];
                    $id_pertandingan = $row['id_pertandingan'];
                    $jumlah_tiket = $row['jumlah_tiket'];
                    $status = $row['status'];

                    // Ambil informasi pertandingan
                    $query_pertandingan = "SELECT * FROM pertandingan WHERE id_pertandingan = $id_pertandingan";
                    $result_pertandingan = $conn->query($query_pertandingan);

                    if ($result_pertandingan && $result_pertandingan->num_rows > 0) {
                        $row_pertandingan = $result_pertandingan->fetch_assoc();
                        $result_pertandingan->free_result();
                        

                        // Generate a unique modal ID using the orderid
                        $modal_id = 'modalPembayaran_' . $orderid . '_' . $id_pertandingan;


                        // Tampilan pembelian tiket
                        ?>
                        <div class="card mb-4"  >
                            <div class="card-header">
                                <?php if ($status === 'Belum Bayar') { ?>
                                    <button class="status btn btn-warning disabled"><?php echo $status ?></button>
                                <?php } elseif ($status === 'Waiting') { ?>
                                    <button class="status btn btn-secondary disabled"><?php echo $status ?></button>
                                <?php } elseif ($status === 'Selesai') { ?>
                                    <button class="status btn btn-success disabled"><?php echo $status ?></button>
                                    <?php } ?>
                                <span>ORDERID:</span>
                                <span><?php echo $orderid ?></span>
                            </div>
                            <div class="card-body">
                                <div class="club-info">
                                        <p class="card-text"><?php echo $row_pertandingan["kompetisi"] ?> MATCH ANTARA <?php echo $row_pertandingan["club_1"] ?> vs <?php echo $row_pertandingan["club_2"] ?></p>
                                        <p>Jumlah Tiket: <?php echo $jumlah_tiket ?></p>
                                    <div class="club-info">
                                        <p>Tanggal Pertandingan: <?php echo $row_pertandingan["tanggal_pertandingan"] ?></p>
                                        <p>Kategori: <?php echo $row["kategori"] ?></p>
                                        <?php if ($status === 'Belum Bayar') { ?>
                                        <button class="btn btn-primary btnPembayaran" data-toggle="modal" data-target="#modalPembayaran_<?php echo $orderid ?>_<?php echo $id_pertandingan ?>" style="position: absolute; bottom: 10px; right: 10px;">Pembayaran</button>
                                        <form method="GET" action="proses/delete-ticket-history.php">
                                            <input type="hidden" name="orderid" value="<?php echo $orderid ?>">
                                            <input type="hidden" name="jumlah_tiket" value="<?php echo $jumlah_tiket ?>">
                                            <button class="btn btn-danger btnHapus" style="position: absolute; bottom: 10px; right: 140px;" onclick="return confirmDelete()">Hapus</button>
                                        </form>
                                    <?php } elseif ($status === 'Waiting') { ?>
                                    <?php } elseif ($status === 'Selesai') { ?>
                                        <div style="text-align: right;">
                                            <a target="_blank" href="admin/proses/invoice.php?orderid=<?= $orderid ?>" class="btn btn-success">Cetak Invoice</a>
                                        </div>                                    
                                    <?php } ?>

                                    <script>
                                        function confirmDelete() {
                                            return confirm("Apakah Anda yakin ingin menghapus data tiket ini?");
                                        }
                                    </script>


                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                <div class="modal fade" id="modalPembayaran_<?php echo $orderid ?>_<?php echo $id_pertandingan ?>" tabindex="-1" role="dialog" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalPembayaranLabel">Form Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="proses/payment.php" method="GET">
                                                    <div class="form-group">
                                                        <label for="pembayaran">Informasi Pembayaran</label>
                                                        <input type="text" class="form-control" id="pembayaran" name="nama_rekening" placeholder="Nama Pemilik Rekening / Sumber Dana" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="metodePembayaran">Metode Pembayaran</label>
                                                        <select class="form-control" id="metodePembayaran" name="metodePembayaran" required>
                                                            <option value="TransferBank">Transfer Bank</option>
                                                            <option value="dompetDigital">Dompet Digital</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="rekeningTujuan">Rekening Tujuan</label>
                                                        <select name="tujuan_pembayaran" class="form-control" required>	
                                                            <option value="" selected="" disabled="">--Pilih Rekening Tujuan--</option>
                                                            <?php $metode = mysqli_query($conn,"SELECT * from tujuan_pembayaran");
                                                            while($a=mysqli_fetch_array($metode)){ ?>
                                                                <option value="<?php echo $a['nama_pembayaran'] ?>"><?php echo $a['nama_pembayaran'] ?> | <?php echo $a['norek'] ?></option>
                                                            <?php }; ?>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggalBayar">Tanggal Bayar</label>
                                                        <input type="date" class="form-control" id="tanggalBayar" name="tanggalBayar" required>
                                                    </div>
                                                    <input type="hidden" name="orderid" value="<?php echo $orderid ?>">
                                                    <input type="hidden" name="id_pertandingan" value="<?php echo $id_pertandingan ?>">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                    <?php
                    }
                }
            } else {
                echo "<p>Tidak ada data tiket.</p>";
            }

            // Menutup koneksi ke database
            $conn->close();
        } else {
            echo "<p>Silakan login untuk melihat history pembelian tiket.</p>";
        }
        ?>
    </div>
</section>

