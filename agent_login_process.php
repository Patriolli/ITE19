<?php
// Assuming you have a database connection
$servername = "localhost"; // Change the port as needed
$username = "root";
$password = "";
$dbname = "car_dealership1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM agents WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Verify the hashed password
        $row = $result->fetch_assoc();
        if ($password == $row["password"]) {
            // Password is correct, redirect to the agent's dashboard
            header("Location: agent_dashboard.php");
            exit();
        } else {
            echo "Login failed. Invalid password.";
        }
    } else {
        echo "Login failed. Invalid username.";
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>
