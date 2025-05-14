<?php
// Veritabanı bağlantısını dahil et
include('config/db.php');

// Kullanıcı işlemleri için session başlat
session_start();

// Kullanıcı giriş yaptıysa, userId session'a kaydedilir
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// `action` parametresi ile hangi işlemin yapılacağı belirlenir
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Ana sayfa (homepage) için varsayılan işlem
if ($action == '') {
    include('views/homepage.php');  // Ana sayfa içerikleri
}

// Kullanıcı girişi veya kaydı
elseif ($action == 'login' || $action == 'register') {
    include('views/login_register.php');  // Giriş ve kayıt formu
}

// Araçlarla ilgili işlemler
elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $action == 'getCars') {
    include('routes/carRoutes.php');
}

// Kullanıcı kayıt işlemi (POST)
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'registerUser') {
    include('routes/userRoutes.php');
}

// Kullanıcı girişi işlemi (POST)
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'loginUser') {
    include('routes/userRoutes.php');
}

// Rezervasyon oluştur (POST)
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'createBooking') {
    include('routes/bookingRoutes.php');
}

// Kullanıcıya ait rezervasyonları listele (GET)
elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $action == 'getBookingsByUser') {
    include('routes/bookingRoutes.php');
}

// Hatalı işlem
else {
    echo "Invalid action or method.";
}
?>
