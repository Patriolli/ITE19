<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Homepage</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addproducts.php">Add products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_order.php">Create Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_contact.php">Create Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_agent.php">Create Agent</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 border border-primary text-light">
    <h2>Orders</h2>
    <?php
    $servername = "localhost"; // Change the port as needed
    $username = "root";
    $password = "";
    $dbname = "car_dealership1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch orders from the database with additional details from contacts and vehicles tables
    $orderQuery = "SELECT orders.order_id, contacts.name AS contact_name, contacts.address, contacts.phone,
                          vehicles.brand, vehicles.model, vehicles.options, vehicles.VIN
                   FROM orders
                   JOIN contacts ON orders.contact_id = contacts.contact_id
                   JOIN vehicles ON orders.VIN = vehicles.VIN";
    $orderResult = $conn->query($orderQuery);

    if ($orderResult->num_rows > 0) {
        echo "<table class='table text-light'>
                <thead>
                    <tr>
                        <th scope='col'>Order ID</th>
                        <th scope='col'>Contact Name</th>
                        <th scope='col'>Contact Address</th>
                        <th scope='col'>Contact Phone</th>
                        <th scope='col'>Vehicle Brand</th>
                        <th scope='col'>Vehicle Model</th>
                        <th scope='col'>Vehicle Options</th>
                        <th scope='col'>VIN</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = $orderResult->fetch_assoc()) {
            echo "<tr>
                    <th scope='row'>" . $row['order_id'] . "</th>
                    <td>" . $row['contact_name'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['brand'] . "</td>
                    <td>" . $row['model'] . "</td>
                    <td>" . $row['options'] . "</td>
                    <td>" . $row['VIN'] . "</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No orders found.";
    }

    $conn->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
