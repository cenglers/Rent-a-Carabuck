<?php
session_start();
include("../php/config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kullanıcı oturum kontrolü
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["status" => "error", "message" => "You must be logged in to book a car."]);
        exit;
    }

    $userId = $_SESSION['user_id'];
    $carId = $_POST['car_id'] ?? null;

    // Giriş kontrolü
    if (!$carId) {
        echo json_encode(["status" => "error", "message" => "Car ID is required."]);
        exit;
    }

    // Araç rezervasyonu
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, car_id, booking_date) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $userId, $carId);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Car booked successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to book car. Please try again."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
