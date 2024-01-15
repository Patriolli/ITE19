<?php
// get_brands.php
header('Content-Type: application/json');

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_dealership1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch unique brands from the models table
$brandQuery = "SELECT distinct brand FROM models";
$brandResult = $conn->query($brandQuery);

if ($brandResult) {
    $brands = array();

    while ($row = $brandResult->fetch_assoc()) {
        $brands[] = $row['brand'];
    }

    echo json_encode(array('status' => 'success', 'data' => $brands));
} else {
    // Set HTTP response status code to 500 (Internal Server Error)
    http_response_code(500);

    // Provide an error message in the response
    echo json_encode(array('status' => 'error', 'message' => 'Query failed: ' . $conn->error));
}

$conn->close();
?>
