<!-- agent_sold_vehicles.php -->

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

// Fetch sold vehicles for the current agent from the vehicles_for_sale table
$soldVehicleQuery = "SELECT brand, model, COUNT(*) as quantity FROM vehicles_for_sale WHERE status = 'sold' GROUP BY brand, model";
$soldVehicleResult = $conn->query($soldVehicleQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Sold Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="agent_dashboard.php">Agent Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
        
                <li class="nav-item active">
                    <a class="nav-link" href="list_vehicles.php">Available Vehicles</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="sold_vehicles.php">Sold Vehicles</a>
                </li>
            </ul>
        </div>                
    </div>
</nav>

<div class="container mt-5">
    <h2>Sold Vehicles</h2>
    <?php
    if ($soldVehicleResult->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>Brand</th><th>Model</th><th>Quantity</th></tr></thead>";
        echo "<tbody>";
        while ($row = $soldVehicleResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['brand']}</td>";
            echo "<td>{$row['model']}</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No sold vehicles.";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
