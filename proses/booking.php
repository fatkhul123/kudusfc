<?php
include "connect.php";

$success_message = "";
$error_message = "";

// Memeriksa apakah parameter id_tiket dan id_pertandingan telah diberikan
if (isset($_GET['id_tiket']) && isset($_GET['id_pertandingan']) && isset($_GET['kategori'])) {
    $id_tiket = $_GET['id_tiket'];
    $id_pertandingan = $_GET['id_pertandingan'];
    $kategori = $_GET['kategori'];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $tanggal = $_GET["tanggal_pembelian"];
        $jumlah_tiket = $_GET["jumlah_tiket"];
        $harga_satuan = $_GET['harga'];
        $harga = str_replace(['Rp.', '.'], '', $harga_satuan);
        $total_harga = intval($jumlah_tiket) * intval($harga);

        // Get the user ID from the session or wherever it is stored
        session_start(); // Start the session
        $id_pengguna = $_SESSION['id_pengguna']; // Replace 'user_id' with the actual session variable name

        // Generate order ID
        $query_id = mysqli_query($conn, "SELECT RIGHT(orderid, 7) AS kode FROM pembelian_tiket ORDER BY orderid DESC LIMIT 1")
            or die('Ada kesalahan pada query tampil kode_transaksi : ' . mysqli_error($conn));
        $count = mysqli_num_rows($query_id);
        if ($count <> 0) {
            $data_id = mysqli_fetch_assoc($query_id);
            $kode = $data_id['kode'] + 1;
        } else {
            $kode = 1;
        }
        $tahun = date("Y");
        $buat_id = str_pad($kode, 7, "0", STR_PAD_LEFT);
        $orderid = "OR-$tahun-$buat_id";

        // Insert into 'order' table
        $sql12 = "INSERT INTO `order` (orderid) VALUES ('$orderid')";
        $result = $conn->query($sql12); 

        if ($result) {
          

        // Insert into 'pembelian_tiket' table
        $sql = "INSERT INTO pembelian_tiket (orderid, id_tiket, id_pertandingan, tanggal_pembelian, jumlah_tiket, total_harga, kategori, id_pengguna, status) 
        VALUES ('$orderid', '$id_tiket', '$id_pertandingan', '$tanggal', '$jumlah_tiket', '$total_harga', '$kategori', '$id_pengguna', 'Belum Bayar')";


            if ($conn->query($sql) === TRUE) {
                // Update ticket stock
                $query = "SELECT * FROM tiket WHERE id_tiket = '$id_tiket'";
                $result = $conn->query($query);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $stokTiket = $row['stok'];
                    $new_stock = $stokTiket - $jumlah_tiket; // Calculate new stock value

                    $update_query = "UPDATE tiket SET stok = '$new_stock' WHERE id_tiket = '$id_tiket'";
                    $conn->query($update_query);
                    $success_message = "Update stok berhasil! Terima kasih.";
                }

                $success_message = "Pembelian tiket berhasil! Terima kasih.";
                echo "<meta http-equiv='refresh' content='0;url=../index.php?page=buy-ticket&id_tiket=".$id_tiket."&id_pertandingan=".$id_pertandingan."&kategori=".$kategori."'>";
               
                                exit;
            } else {
                $error_message = "Error: " . $conn->error;
            }
        } else {
            $error_message = "Error: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        $error_message = "ID tiket dan ID pertandingan tidak diberikan.";
    }
}
?>
<!-- Display the success or error messages -->
<?php if (!empty($success_message)): ?>
    <div class="alert alert-success"><?php echo $success_message; ?></div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>