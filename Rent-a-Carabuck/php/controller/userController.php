<?php
include("../models/userModel.php");

class UserController {
    private $userModel;

    public function __construct($dbConnection) {
        $this->userModel = new UserModel($dbConnection);
    }

    // Yeni kullanıcı kaydet
    public function registerUser($username, $email, $password) {
        return $this->userModel->registerUser($username, $email, $password);
    }

    // Kullanıcı girişi yap
    public function loginUser($email, $password) {
        return $this->userModel->loginUser($email, $password);
    }

    // Kullanıcı bilgilerini al
    public function getUserById($userId) {
        return $this->userModel->getUserById($userId);
    }
}
?>
