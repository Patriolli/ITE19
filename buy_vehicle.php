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
    $vin = $_POST["vin"];

    // Update the status of the vehicle to 'sold'
    $updateSql = "UPDATE vehicles_for_sale SET status = 'sold' WHERE VIN = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("s", $vin);

    if ($updateStmt->execute()) {
        header("Location:customer_dashboard.php");
    } else {
        echo "Error updating vehicle status: " . $updateStmt->error;
    }

    $updateStmt->close();
}

$conn->close();
?>
