<?php
include("../controllers/bookingController.php");
include("../config/db.php");

// Yeni rezervasyon oluştur
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'createBooking') {
    $bookingController = new BookingController($conn);
    $userId = $_POST['userId'];
    $carId = $_POST['carId'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    
    $result = $bookingController->createBooking($userId, $carId, $startDate, $endDate);
    echo json_encode(["success" => $result]);
}

// Kullanıcıya ait rezervasyonları al
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'getBookingsByUser' && isset($_GET['userId'])) {
    $bookingController = new BookingController($conn);
    $bookings = $bookingController->getBookingsByUser($_GET['userId']);
    echo json_encode($bookings);
}

// Rezervasyon durumunu güncelle
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'updateBookingStatus') {
    $bookingController = new BookingController($conn);
    $bookingId = $_POST['bookingId'];
    $status = $_POST['status'];
    
    $result = $bookingController->updateBookingStatus($bookingId, $status);
    echo json_encode(["success" => $result]);
}

// Rezervasyonu iptal et
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'cancelBooking') {
    $bookingController = new BookingController($conn);
    $bookingId = $_POST['bookingId'];
    
    $result = $bookingController->cancelBooking($bookingId);
    echo json_encode(["success" => $result]);
}
?>
