<?php
session_start();
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = hash("sha256", $_POST['password']);

  $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND password = ?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $_SESSION['user_id'] = $user_id;
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Invalid login credentials.";
  }
}
?>
<form method="POST">
  <input type="email" name="email" required>
  <input type="password" name="password" required>
  <button type="submit">Login</button>
</form>
