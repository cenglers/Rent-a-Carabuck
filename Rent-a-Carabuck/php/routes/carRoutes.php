<?php
include("../controllers/carController.php");
include("../config/db.php");

// Araçları listele
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'getCars') {
    $carController = new CarController($conn);
    $cars = $carController->getCars();
    echo json_encode($cars);
}

// Belirli bir aracı göster
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'getCarById' && isset($_GET['carId'])) {
    $carController = new CarController($conn);
    $car = $carController->getCarById($_GET['carId']);
    echo json_encode($car);
}

// Araç ekle
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'addCar') {
    $carController = new CarController($conn);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    
    $result = $carController->addCar($name, $description, $price, $image);
    echo json_encode(["success" => $result]);
}
?>
