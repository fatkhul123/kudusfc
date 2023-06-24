<?php
include "proses/connect.php";

// Query untuk mendapatkan data pengguna dengan role == user
$sql = "SELECT * FROM pengguna WHERE role_pengguna = 'user'";
$result = $conn->query($sql);
?>

    <div class="container">
        <h2>Daftar Pengguna</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nama_pengguna'] . "</td>";
                        echo "<td>" . $row['email_pengguna'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['role_pengguna'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada pengguna dengan peran 'user'.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
$conn->close();
?>
