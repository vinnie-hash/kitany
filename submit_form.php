<?php
$servername = "localhost";
$username = "root"; 
$password = "";      
$dbname = "drillers";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['name']) && isset($_POST['message'])) {
    $full_name = $conn->real_escape_string($_POST['name']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO inquiry (full_name, message) VALUES ('$full_name', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
