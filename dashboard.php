<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Hoş geldiniz, <?php echo $_SESSION['user']; ?>!</h1>
  <p><a href="cars.php">Araçları Görüntüle ve Kirala</a></p>
  <p><a href="reservations.php">Rezervasyonlarım</a></p>
  <p><a href="logout.php">Çıkış Yap</a></p>
</body>
</html>
