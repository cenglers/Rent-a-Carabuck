<?php
include("includes/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = hash("sha256", $_POST['password']);
  $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  echo "Registered successfully!";
}
?>
<form method="POST" onsubmit="return validateForm();">
  <input type="email" name="email" required>
  <input type="password" name="password" required>
  <button type="submit">Register</button>
</form>
<script src="js/validate.js"></script>
