<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $tempat = $_POST['tempat'];
    $club1 = $_POST['club1'];
    $club2 = $_POST['club2'];
    $waktu = $_POST['waktu'];
    $kompetisi = $_POST['kompetisi'];
    $kota = $_POST['kota'];
    $provinsi = $_POST['provinsi'];

    // Mengunggah gambar pertandingan
    $nama_file = $_FILES['gambar']['name'];
  $source = $_FILES['gambar']['tmp_name'];
  $folder = '../assets/img/';

    if (move_uploaded_file($source, $folder.$nama_file)) {
        // Menambahkan data pertandingan ke dalam database
        $sql = "INSERT INTO pertandingan (tanggal_pertandingan, tempat_pertandingan, club_1, club_2, gambar_pertandingan, waktu, kompetisi, kota, provinsi) VALUES ('$tanggal', '$tempat', '$club1', '$club2', '$nama_file', '$waktu', '$kompetisi', '$kota', '$provinsi')";

        if ($conn->query($sql) === TRUE) {
            echo "Pertandingan berhasil ditambahkan.";
            header("Location: ../index.php?page=kelola-pertandingan");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}

$conn->close();
?>
