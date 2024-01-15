<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

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
        // Check if all required fields are set
        if (isset($_POST['vin'], $_POST['brand'], $_POST['model'], $_POST['options'])) {
            $vin = $_POST['vin'];
            $brand = $_POST['brand'];
            $model = $_POST['model'];
            $options = $_POST['options'];

            // Use prepared statement to prevent SQL injection
            $sql = "INSERT INTO vehicles (vin, brand, model, options) VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            // Bind parameters to the SQL query
            $stmt->bind_param("ssss", $vin, $brand, $model, $options);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Vehicle added successfully!";
                // Redirect back to the create product page
                header("Location: addproducts.php");
                exit(); // Ensure that no further code is executed after the redirect
            } else {
                echo "Error adding vehicle: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "All fields are required.";
        }
    }

    // Fetch distinct brands from the database
    $brandQuery = "SELECT DISTINCT brand FROM brands_models";
    $brandResult = $conn->query($brandQuery);

    while ($row = $brandResult->fetch_assoc()) {
        echo "<option value='" . $row['brand'] . "'>" . $row['brand'] . "</option>";
    }

    $conn->close();
?>