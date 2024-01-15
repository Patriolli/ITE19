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
    // Check if all required fields are set
    if (isset($_POST['name'], $_POST['company'], $_POST['address'], $_POST['phone'])) {
        $name = $_POST['name'];
        $company = $_POST['company'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO agents (name, company, address, phone) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters to the SQL query
        $stmt->bind_param("ssss", $name, $company, $address, $phone);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Agent created successfully!";
            header("Location: create_agent.php");
        } else {
            echo "Error creating agent: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}

// Close the connection
$conn->close();
?>
