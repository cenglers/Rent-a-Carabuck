<?php
include("../includes/db.php");
session_start();
$car_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("INSERT INTO bookings (user_id, car_id) VALUES ($user_id, $car_id)");
$conn->query("UPDATE cars SET available = 0 WHERE id = $car_id");

echo "Car booked successfully!";
