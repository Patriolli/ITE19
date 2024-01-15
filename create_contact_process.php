<?php
$servername = "localhost"; // Change the port as needed
$username = "root";
$password = "";
$dbname = "car_dealership1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO contacts (name, address, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $address, $phone);

    if ($stmt->execute()) {
        // Redirect back to the create_contact.php page
        header("Location: create_contact.php");
        exit(); // Make sure to exit after header redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
