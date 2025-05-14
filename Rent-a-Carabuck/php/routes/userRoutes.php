<?php
include("../controllers/userController.php");
include("../config/db.php");

// Kullanıcı kaydını oluştur
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'registerUser') {
    $userController = new UserController($conn);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $userController->registerUser($username, $email, $password);
    echo json_encode(["success" => $result]);
}

// Kullanıcı girişi yap
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'loginUser') {
    $userController = new UserController($conn);
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $userController->loginUser($email, $password);
    if ($user) {
        echo json_encode(["success" => true, "user" => $user]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid credentials"]);
    }
}

// Kullanıcı bilgilerini al
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'getUserById' && isset($_GET['userId'])) {
    $userController = new UserController($conn);
    $user = $userController->getUserById($_GET['userId']);
    echo json_encode($user);
}
?>
