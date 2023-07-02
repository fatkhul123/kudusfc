<?php
include 'connect.php';

if (isset($_POST['bulan'])) {
    $bulan = $_POST['bulan'];
    
    $sql = mysqli_query($conn, "SELECT * FROM pembelian_tiket d 
        INNER JOIN pertandingan p ON d.id_pertandingan = p.id_pertandingan 
        ORDER BY d.id_pertandingan ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Penjualan</title>
    <style type="text/css">
        @charset "utf-8";
        /* CSS Document */

        /* CSS styles go here */

    </style>
</head>
<body>
    <div id="title">
        LAPORAN PENJUALAN
    </div>
    <?php
    $bln = array(
        "",
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    );
    ?>
    <div id="title-tanggal">
        Periode Bulan <?= $bln[$bulan]; ?>
    </div>
    <hr>
    <br>
    <div id="isi">
        <table width="100%" border="1" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">KODE ORDER</th>
                    <th height="20" align="center" valign="middle">TANGGAL</th>
                    <th height="20" align="center" valign="middle">NAMA</th>
                    <th height="20" align="center" valign="middle">QTY</th>
                    <th height="20" align="center" valign="middle">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;
                if (mysqli_num_rows($sql) > 0) {
                    while ($l = mysqli_fetch_array($sql)) {
                        ?>
                        <tr style="height: 20px">
                            <td><?= $no++ ?></td>
                            <td><?= $l['orderid'] ?></td>
                            <td><?= $l['tanggal_pembelian'] ?></td>
                            <td><?= $l["kompetisi"]; ?> MATCH ANTARA <?= $l["club_1"]; ?> vs <?= $l["club_2"]; ?></td>
                            <td><?= $l['jumlah_tiket'] ?></td>
                            <td>Rp. <?= number_format($l['total_harga']) ?></td>
                        </tr>
                        <?php
                        $total += $l['total_harga'];
                    }
                } else {
                    ?>
                    <tr style="height: 40px">
                        <td colspan="6">Data tidak ditemukan</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <br>
        Total Pendapatan: <b>Rp. <?= number_format($total) ?></b>
    </div>
</body>
</html>
<script type="text/javascript">
    function PrintWindow() {
        window.print();
        CheckWindowState();
    }

    function CheckWindowState() {
        if (document.readyState == "complete") {
            window.close();
        } else {
            setTimeout("CheckWindowState()", 1000);
        }
    }

    PrintWindow();
</script>
<?php
} else {
    echo "No data received";
}
?>
