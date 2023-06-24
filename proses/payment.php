<?php

include "connect.php";

$success_message = "";
$error_message = "";

// Memeriksa apakah parameter orderid telah diberikan
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $metode_pembayaran = $_GET['metodePembayaran'];
        $nama_rekening = $_GET['nama_rekening'];
        $tanggalBayar = $_GET['tanggalBayar'];
        $orderid = $_GET['orderid'];
        
        session_start();
        $id_pengguna = $_SESSION['id_pengguna'];

        // Menyesuaikan query berdasarkan metode pembayaran
        if ($metode_pembayaran == "TransferBank") {
            $sql = "INSERT INTO pembayaran (orderid, id_pengguna, nama_rekening, metode_pembayaran, tanggal_bayar)
                    VALUES ('$orderid', '$id_pengguna', '$nama_rekening', 'Bank BRI', '$tanggalBayar')";
        } elseif ($metode_pembayaran == "dompetDigital") {
            // Tambahkan kode untuk metode dompet digital OVO
            $sql = "INSERT INTO pembayaran (orderid, id_pengguna, nama_rekening, metode_pembayaran, tanggal_bayar)
                    VALUES ('$orderid', '$id_pengguna', '$nama_rekening', 'OVO', '$tanggalBayar')";
        } else {
            $error_message = "Metode pembayaran tidak valid.";
        }

        if (empty($error_message)) {
            if ($conn->query($sql) === TRUE) {
                $query = "SELECT * FROM pembelian_tiket WHERE orderid = '$orderid'";
                $result = $conn->query($query);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $update_query = "UPDATE pembelian_tiket SET status = 'Waiting' WHERE orderid = '$orderid'";
                    $conn->query($update_query);
                    $success_message = "Update stok berhasil! Terima kasih.";
                }
                $success_message = "Pembelian tiket berhasil! Terima kasih.";
                header("Location: ../index.php?page=histori");
                exit;
            } else {
                $error_message = "Error: " . $conn->error;
            }
        }
    } else {
        $error_message = "Error: " . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
} else {
    $error_message = "Order ID tidak diberikan.";
}
?>

<!-- Menampilkan pesan sukses atau error -->
<?php if (!empty($success_message)): ?>
    <div class="alert alert-success"><?php echo $success_message; ?></div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>
