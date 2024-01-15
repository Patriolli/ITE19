<?php
// list_for_sale.php

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
    // Extract brand and model from the selected option
    $selectedVehicle = explode("|", $_POST["brand_model"]);
    $brand = $selectedVehicle[0];
    $model = $selectedVehicle[1];

    $salePrice = $_POST["sale_price"];

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO vehicles_for_sale (VIN, brand, model, sale_price) 
            SELECT VIN, brand, model, ? FROM vehicles 
            WHERE brand = ? AND model = ? AND status = 'available'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $salePrice, $brand, $model);

    if ($stmt->execute()) {
        header("Location: agent_dashboard.php");
    } else {
        echo "Error listing vehicle for sale: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
