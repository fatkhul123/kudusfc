<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Query untuk mendapatkan data pertandingan berdasarkan ID
    $sql = "SELECT * FROM pertandingan WHERE id_pertandingan = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Hapus gambar dari direktori
        $gambarPath = '../assets/img/' . $row['gambar_pertandingan'];
        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        // Hapus data pertandingan dari tabel
        $deleteSql = "DELETE FROM pertandingan WHERE id_pertandingan = $id";
        if ($conn->query($deleteSql) === TRUE) {
            echo "Pertandingan berhasil dihapus.";
            header("Location: ../index.php?page=kelola-pertandingan");
            exit();
        } else {
            echo "Error: " . $deleteSql . "<br>" . $conn->error;
            exit();
        }
    } else {
        echo "Pertandingan tidak ditemukan.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

$conn->close();
?>
