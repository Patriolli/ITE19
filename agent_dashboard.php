<!-- agent_dashboard.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard</title>
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
    <h2>Welcome, Agent!</h2>

    <!-- Display the form for listing a vehicle for sale -->
    <form method="post" action="list_for_sale.php">
        <label for="brand_model">Select Vehicle:</label>
        <select name="brand_model" required>
            <?php
            // Fetch available vehicles (brand and model) from the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "car_dealership1";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = "SELECT DISTINCT VIN, brand, model FROM vehicles WHERE status = 'available'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['brand'] . "|" . $row['model'] . "'>" . $row['brand'] . " " . $row['model'] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No vehicles available for sale</option>";
            }

            $conn->close();
            ?>
        </select>

        <label for="sale_price">Sale Price:</label>
        <input type="text" name="sale_price" required>

        <input type="submit" value="List for Sale">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
