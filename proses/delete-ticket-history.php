<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $orderid = $_GET['orderid'];
    $jumlah_tiket = $_GET['jumlah_tiket'];

    // Tambahkan kode validasi atau pemeriksaan lainnya sesuai kebutuhan

    // Mengambil ID tiket berdasarkan orderid
    $query = "SELECT id_tiket FROM pembelian_tiket WHERE orderid = '$orderid'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_tiket = $row['id_tiket'];

        // Lakukan proses penghapusan data sesuai dengan logika yang diinginkan
        $delete_query = "DELETE FROM pembelian_tiket WHERE orderid = '$orderid'";
        if ($conn->query($delete_query) === TRUE) {
            // Tambahkan kode untuk mengembalikan stok tiket
            $update_query = "UPDATE tiket SET stok = stok + $jumlah_tiket WHERE id_tiket = '$id_tiket'";
            $conn->query($update_query);

            // Redirect atau lakukan tindakan lain setelah penghapusan dan penambahan stok berhasil
            header("Location: ../index.php?page=histori");
            exit;
        } else {
            $error_message = "Error: " . $conn->error;
        }
    } else {
        $error_message = "Tidak dapat mengambil ID tiket.";
    }

    // Tutup koneksi database
    $conn->close();
}
?>

?>
