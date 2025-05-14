<?php
include("../models/carModel.php");

class CarController {
    private $carModel;

    public function __construct($dbConnection) {
        $this->carModel = new CarModel($dbConnection);
    }

    // Tüm araçları al
    public function getCars() {
        return $this->carModel->getCars();
    }

    // Belirli bir aracı al
    public function getCarById($id) {
        return $this->carModel->getCarById($id);
    }

    // Yeni araç ekle
    public function addCar($name, $description, $price, $image) {
        return $this->carModel->addCar($name, $description, $price, $image);
    }

    // Araç rezervasyonu yap
    public function bookCar($carId) {
        return $this->carModel->bookCar($carId);
    }
}
?>
