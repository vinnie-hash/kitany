<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "drillers"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully.<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $location = $_POST['location'];
    $project_details = $_POST['project_details'];

   
    echo "Received Data:<br>";
    echo "Full Name: $full_name<br>";
    echo "Email: $email<br>";
    echo "Phone Number: $phone_number<br>";
    echo "Location: $location<br>";
    echo "Project Details: $project_details<br>";

   
    $stmt = $conn->prepare("INSERT INTO quote (full_name, email, phone_number, location, project_details) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sssss", $full_name, $email, $phone_number, $location, $project_details);

    
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>