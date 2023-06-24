<!DOCTYPE html>
<html>
<head>
    <title>Pertandingan - Edit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Pertandingan - Edit</h2>

        <?php
        include "proses/connect.php";

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query untuk mendapatkan data pertandingan berdasarkan ID
            $sql = "SELECT * FROM pertandingan WHERE id_pertandingan = $id";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>

                <form action="proses/edit-pertandingan.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id_pertandingan']; ?>">
                    <div class="form-group">
                        <label>Tanggal Pertandingan</label>
                        <input type="date" class="form-control" name="tanggal" value="<?php echo $row['tanggal_pertandingan']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Tempat Pertandingan</label>
                        <input type="text" class="form-control" name="tempat" value="<?php echo $row['tempat_pertandingan']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Club 1</label>
                        <input type="text" class="form-control" name="club1" value="<?php echo $row['club_1']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Club 2</label>
                        <input type="text" class="form-control" name="club2" value="<?php echo $row['club_2']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Gambar Pertandingan</label>
                        <input type="file" class="form-control-file" name="gambar">
                        <img src="../<?php echo $row['gambar_pertandingan']; ?>" width="100" height="100">
                    </div>
                    <button type="submit" class="btn btn-primary">edit</button>
                    <a href="index.php?page=kelola-pertandingan" class="btn btn-secondary">Kembali</a>
                </form>
                
                <?php
            } else {
                echo "Pertandingan tidak ditemukan.";
            }
        } else {
            echo "ID Pertandingan tidak valid.";
        }
        ?>

    </div>
</body>
</html>
