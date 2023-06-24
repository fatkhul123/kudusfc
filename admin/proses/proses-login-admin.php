<?php
session_start();

include "connect.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($username)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM pengguna WHERE username='$username' AND password_pengguna='$pass'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nama = $row['username'];

            if ($row['username'] === $username && $row['password_pengguna'] === $pass && $row['role_pengguna']  == 'admin') {
                echo "Logged in!";
                $_SESSION['id_pengguna'] = $row['id_pengguna'];
                $_SESSION['username'] = $row['username']; 
                $_SESSION['role_pengguna'] = $row['role_pengguna']; 


                header("Location: ../index.php?page=home");
                exit(); 
            } else {
                header("Location: index.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}

?>
