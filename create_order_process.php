<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_dealership1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_id = $_POST["contact"];
    $VIN = $_POST["VIN"];

    // Insert the order into the 'orders' table
    $sql = "INSERT INTO orders (contact_id, VIN, address) VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // For simplicity, assuming you have an 'address' field in the form
        $address = $_POST["address"];

        $stmt->bind_param("iss", $contact_id, $VIN, $address);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Redirect to the homepage after successful order creation
            header("Location: homepage.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
