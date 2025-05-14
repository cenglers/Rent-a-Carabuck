<?php
include("../models/bookingModel.php");

class BookingController {
    private $bookingModel;

    public function __construct($dbConnection) {
        $this->bookingModel = new BookingModel($dbConnection);
    }

    // Yeni rezervasyon oluştur
    public function createBooking($userId, $carId, $startDate, $endDate) {
        return $this->bookingModel->createBooking($userId, $carId, $startDate, $endDate);
    }

    // Kullanıcıya ait tüm rezervasyonları getir
    public function getBookingsByUser($userId) {
        return $this->bookingModel->getBookingsByUser($userId);
    }

    // Rezervasyonun durumunu güncelle
    public function updateBookingStatus($bookingId, $status) {
        return $this->bookingModel->updateBookingStatus($bookingId, $status);
    }

    // Rezervasyonu iptal et
    public function cancelBooking($bookingId) {
        return $this->bookingModel->cancelBooking($bookingId);
    }
}
?>
