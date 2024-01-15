<!-- view_available_vehicles.php -->

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

// Fetch available vehicles from the database
$vehicleQuery = "SELECT * FROM vehicles WHERE status = 'available'";
$vehicleResult = $conn->query($vehicleQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Available Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">View Available Vehicles</a>
        <!-- Add any other navigation links if needed -->
    </div>
</nav>

<div class="container mt-5">
    <h2>Available Vehicles</h2>
    <?php
    if ($vehicleResult->num_rows > 0) {
        echo "<ul>";
        while ($row = $vehicleResult->fetch_assoc()) {
            echo "<li>{$row['brand']} {$row['model']} (VIN: {$row['VIN']})</li>";
        }
        echo "</ul>";
    } else {
        echo "No available vehicles.";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
