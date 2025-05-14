<?php
class CarModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Tüm araçları getir
    public function getCars() {
        $sql = "SELECT id, name, description, price, image, available FROM cars WHERE available = 1";
        $result = $this->conn->query($sql);

        $cars = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cars[] = $row;
            }
        }

        return $cars;
    }

    // Araç ID'sine göre araç bilgisi getir
    public function getCarById($id) {
        $stmt = $this->conn->prepare("SELECT id, name, description, price, image, available FROM cars WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Araç ekleme
    public function addCar($name, $description, $price, $image) {
        $stmt = $this->conn->prepare("INSERT INTO cars (name, description, price, image, available) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("ssds", $name, $description, $price, $image);
        return $stmt->execute();
    }

    // Araç rezervasyonu yapıldığında aracın durumu değiştir
    public function bookCar($carId) {
        $stmt = $this->conn->prepare("UPDATE cars SET available = 0 WHERE id = ?");
        $stmt->bind_param("i", $carId);
        return $stmt->execute();
    }
}
?>
