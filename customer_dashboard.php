<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Customer Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Customer Dashboard</a>
        </div>
    </nav>

    <div class="container mt-5 border border-primary p-3">
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

        // Fetch vehicles that are available for sale
        $sql = "SELECT * FROM vehicles_for_sale WHERE status = 'available'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Vehicles Available for Sale</h2>";
            echo "<table class='table'>";
            echo "<thead><tr><th>Brand</th><th>Model</th><th>Sale Price</th><th>Action</th></tr></thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["brand"] . "</td>";
                echo "<td>" . $row["model"] . "</td>";
                echo "<td>$" . $row["sale_price"] . "</td>";
                echo "<td><form method='post' action='buy_vehicle.php'><input type='hidden' name='vin' value='" . $row["VIN"] . "'><button type='submit' class='btn btn-primary'>Buy</button></form></td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "No vehicles available for sale.";
        }

        $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
