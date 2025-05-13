<?php
include("includes/admin_auth.php");
include("includes/db.php");

// Araba ekleme
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['model'])) {
  $model = $_POST['model'];
  $conn->query("INSERT INTO cars (model, available) VALUES ('$model', 1)");
}

// Araba silme
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM cars WHERE id = $id");
}

$cars = $conn->query("SELECT * FROM cars");
?>

<h2>Car List</h2>
<ul>
<?php while ($row = $cars->fetch_assoc()) {
  echo "<li>{$row['model']} (Available: {$row['available']}) - <a href='?delete={$row['id']}'>Delete</a></li>";
} ?>
</ul>

<h3>Add New Car</h3>
<form method="POST">
  <input type="text" name="model" required>
  <button type="submit">Add Car</button>
</form>
<a href="logout.php">Logout</a>
