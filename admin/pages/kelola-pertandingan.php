<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>Daftar Pertandingan</h4>
            <div class="text-right">
                <a href="index.php?page=tambah-pertandingan" class="btn btn-primary" style='margin-bottom : 10px'>Tambah</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Gambar Pertandingan</th>
                        <th>Tanggal Pertandingan</th>
                        <th>Tempat Pertandingan</th>
                        <th>Kompetisi</th>
                        <th>Club 1</th>
                        <th>Club 2</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../proses/connect.php';

                    // Query untuk mendapatkan data pertandingan dari tabel
                    $sql = "SELECT * FROM pertandingan";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><img src='../assets/img/" . $row['gambar_pertandingan'] . "' width='100' height='100'></td>";
                            echo "<td>" . $row['tanggal_pertandingan'] . "</td>";
                            echo "<td>" . $row['tempat_pertandingan'] . "</td>";
                            echo "<td>" . $row['kompetisi'] . "</td>";
                            echo "<td>" . $row['club_1'] . "</td>";
                            echo "<td>" . $row['club_2'] . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?page=edit-pertandingan&id=" . $row['id_pertandingan'] . "' class='btn btn-primary'>Edit</a>";
                            echo "<form method='POST' action='proses/hapus-pertandingan.php' style='display: inline-block;'>
                                    <input type='hidden' name='id' value='" . $row['id_pertandingan'] . "'>
                                    <button type='submit' class='btn btn-danger' style ='margin-left : 5px;' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pertandingan ini?\")'>Hapus</button>
                                  </form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Tidak ada data pertandingan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
