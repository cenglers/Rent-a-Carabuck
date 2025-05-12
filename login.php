<?php
include 'db.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$hashedPassword = hash('sha256', $password);

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $hashedPassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $_SESSION['user'] = $email;
    header("Location: dashboard.php");
} else {
    echo "Giriş başarısız.";
}
?>
