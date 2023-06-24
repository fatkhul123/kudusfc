<?php
include "connect.php";

$success_message = "";
$error_message = "";

// Memeriksa apakah parameter id_tiket dan id_pertandingan telah diberikan
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $nama = $_GET["nama"];
        $email = $_GET["email"];
        $nohp = $_GET['nohp'];

        // Insert into 'pembelian_tiket' table
        $update_query = "UPDATE pembelian_tiket SET nama_pembeli = '$nama', email_pembeli = '$email', no_hp = '$nohp' WHERE orderid = '$orderid'";

        if ($conn->query($update_query) === TRUE) {
            $success_message = "Pembelian tiket berhasil! Terima kasih.";
            header("Location: ../index.php?page=histori");
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
?>

<!-- Display the success or error messages -->
<?php if (!empty($success_message)): ?>
    <div class="alert alert-success"><?php echo $success_message; ?></div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>
