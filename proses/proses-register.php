<?php
include "connect.php";

$success_message = "";
$error_message = "";

// Memeriksa apakah ada data yang dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Mendapatkan nilai yang dikirim dari form registrasi
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Proses validasi registrasi
  if (validateRegistration($email)) {
    // Jika registrasi berhasil, simpan informasi pengguna ke dalam database
    $sql = "INSERT INTO pengguna (nama_pengguna,username, email_pengguna, password_pengguna, role_pengguna) VALUES ('$nama','$username', '$email', '$password', 'user')";
    
    if ($conn->query($sql) === TRUE) {
      $success_message = "Registrasi berhasil! Silakan login.";
      header('Location: ../login.php');

    } else {
      $error_message = "Error: " . $conn->error;
    }
  } else {
    $error_message = "Email telah terdaftar. Silakan gunakan email lain.";
  }

  // Menutup koneksi database
  $conn->close();
}

// Fungsi untuk validasi registrasi (contoh sederhana)
function validateRegistration($email) {
  // Ganti logika validasi ini dengan logika yang sesuai dengan sistem Anda
  // Misalnya, periksa apakah email sudah terdaftar dalam database
  $existingEmail = 'example@example.com';

  if ($email === $existingEmail) {
    return false;
  } else {
    return true;
  }
}
?>

<!-- Menampilkan pesan sukses atau error -->
<?php if (!empty($success_message)): ?>
    <div class="alert alert-success"><?php echo $success_message; ?></div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>

<!-- Form registrasi -->
<form method="POST" action="">
  <label for="nama">Nama:</label>
  <input type="text" name="nama" id="nama" required>

  <label for="email">Email:</label>
  <input type="email" name="email" id="email" required>

  <label for="password">Password:</label>
  <input type="password" name="password" id="password" required>

  <button type="submit">Register</button>
</form>
