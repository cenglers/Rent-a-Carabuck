<?php
include("includes/auth.php");
include("includes/db.php");

$result = $conn->query("SELECT * FROM cars WHERE available = 1");

echo "<h2>Available Cars</h2><ul>";
while ($row = $result->fetch_assoc()) {
  echo "<li>{$row['model']} - <button onclick='bookCar({$row['id']})'>Book</button></li>";
}
echo "</ul>";
?>

<div id="result"></div>
<script>
function bookCar(id) {
  fetch("ajax/book_car.php?id=" + id)
    .then(res => res.text())
    .then(data => {
      document.getElementById("result").innerHTML = data;
      setTimeout(() => location.reload(), 1000);
    });
}
</script>
