<?php
class BookingModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Yeni rezervasyon yap
    public function createBooking($userId, $carId, $startDate, $endDate) {
        $stmt = $this->conn->prepare("INSERT INTO bookings (user_id, car_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->bind_param("iiss", $userId, $carId, $startDate, $endDate);
        return $stmt->execute();
    }

    // Kullanıcıya ait tüm rezervasyonları al
    public function getBookingsByUser($userId) {
        $stmt = $this->conn->prepare("SELECT b.id, c.name AS car_name, b.start_date, b.end_date, b.status FROM bookings b JOIN cars c ON b.car_id = c.id WHERE b.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $bookings = [];

        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }

        return $bookings;
    }

    // Rezervasyonun durumunu güncelle (onaylama, reddetme)
    public function updateBookingStatus($bookingId, $status) {
        $stmt = $this->conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $bookingId);
        return $stmt->execute();
    }

    // Rezervasyonu iptal et
    public function cancelBooking($bookingId) {
        $stmt = $this->conn->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $bookingId);
        return $stmt->execute();
    }
}
?>
