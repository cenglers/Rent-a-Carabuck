<?php
// Veritabanı bağlantısını dahil et
include('config/db.php');

// Eğer formdan veri gönderildiyse
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formdan gelen verileri al
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Şifreyi güvenli hale getirmek için hash ile şifrele
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Kullanıcıyı veritabanına eklemek için SQL sorgusu
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

    // Sorguyu çalıştır ve kontrol et
    if (mysqli_query($conn, $sql)) {
        // Kayıt başarılıysa, kullanıcıyı giriş sayfasına yönlendir
        header("Location: login.php");
        exit();
    } else {
        // Hata mesajı
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Car Rental</title>
</head>
<body>
    <h1>Create an Account</h1>

    <!-- Kayıt formu -->
    <form method="POST" action="register.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
