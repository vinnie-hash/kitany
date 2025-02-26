<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

try {
   
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name     = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone    = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $details  = isset($_POST['details']) ? trim($_POST['details']) : '';

  
    if (empty($name) || empty($email) || empty($phone) || empty($location) || empty($details)) {
        echo "All fields are required. Please go back and fill in all details.";
        exit;
    }

    
    $sql = "INSERT INTO quotes (name, email, phone, location, details) 
            VALUES (:name, :email, :phone, :location, :details)";
    $stmt = $pdo->prepare($sql);

    try {
        
        $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':phone'    => $phone,
            ':location' => $location,
            ':details'  => $details
        ]);

       
        echo "Thank you for your submission!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>