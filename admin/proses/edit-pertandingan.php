<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $tempat = $_POST['tempat'];
    $club1 = $_POST['club1'];
    $club2 = $_POST['club2'];

    // Memperbarui data pertandingan tanpa gambar
    $sql = "UPDATE pertandingan SET tanggal_pertandingan='$tanggal', tempat_pertandingan='$tempat', club_1='$club1', club_2='$club2' WHERE id_pertandingan=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui.";

        // Memperbarui gambar pertandingan jika ada pembaruan gambar
        if ($_FILES['gambar']['name'] != '') {
             // Mengunggah gambar pertandingan
                $nama_file = $_FILES['gambar']['name'];
                $source = $_FILES['gambar']['tmp_name'];
                $folder = '../assets/img/';

            if (move_uploaded_file($source, $folder.$nama_file)) {
                // Memperbarui nama gambar pada database
                $sql = "UPDATE pertandingan SET gambar_pertandingan='$nama_file' WHERE id_pertandingan=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "Gambar berhasil diperbarui.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
                    echo 'Terjadi kesalahan saat mengunggah gambar. Error code: ' . $_FILES['gambar']['error'];
                    exit();
                }
                
            }
        }

        header("Location: ../index.php?page=kelola-pertandingan");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
