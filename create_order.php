<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Create Order</title>
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

<div class="container mt-5">
    <h2>Create a New Order</h2>
    <form method="post" action="create_order_process.php" class="border border-primary p-4">
        <div class="mb-4">
            <label for="contact" class="form-label">Select Contact</label>
            <select class="form-select" id="contact" name="contact" required>
                <option value="" disabled selected>Select a Contact</option>
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

                // Fetch contacts from the database
                $contactQuery = "SELECT * FROM contacts";
                $contactResult = $conn->query($contactQuery);

                while ($row = $contactResult->fetch_assoc()) {
                    echo "<option value='" . $row['contact_id'] . "' data-address='" . $row['address'] . "'>" . $row['name'] . "</option>";
                }

                $conn->close();
                ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="VIN" class="form-label">Select Vehicle</label>
            <select class="form-select" id="VIN" name="VIN" required>
                <option value="" disabled selected>Select a Vehicle</option>
                <?php
                // Assuming you have a database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch vehicles from the database
                $vehicleQuery = "SELECT * FROM vehicles";
                $vehicleResult = $conn->query($vehicleQuery);

                while ($row = $vehicleResult->fetch_assoc()) {
                    echo "<option value='" . $row['VIN'] . "'>" . $row['brand'] . " " . $row['model'] . "</option>";
                }

                $conn->close();
                ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="address" class="form-label">Contact Address</label>
            <input type="text" class="form-control" id="address" name="address" readonly>
        </div>
        <!-- Other input fields for order details... -->
        <input type="submit" class="btn btn-primary" value="Create Order">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
// jQuery script to dynamically update the address field based on the selected contact
$(document).ready(function() {
    $('#contact').change(function() {
        var selectedOption = $('#contact option:selected');
        var address = selectedOption.data('address');
        $('#address').val(address);
    });
});
</script>

</body>
</html>
