<?php
include("../php/config/db.php");

header('Content-Type: application/json');

$sql = "SELECT id, name, description, price, image FROM cars WHERE available = 1";
$result = $conn->query($sql);

$cars = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
}

echo json_encode($cars);

$conn->close();
?>
