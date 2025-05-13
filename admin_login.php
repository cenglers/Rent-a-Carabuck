
<?php
session_start();
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = hash("sha256", $_POST['password']);

  $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND password = ? AND is_admin = 1");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($admin_id);
    $stmt->fetch();
    $_SESSION['admin_id'] = $admin_id;
    header("Location: admin_dashboard.php");
    exit();
  } else {
    echo "Invalid admin credentials.";
  }
}
?>
<form method="POST">
  <input type="email" name="email" required>
  <input type="password" name="password" required>
  <button type="submit">Admin Login</button>
</form>
