<?php
// Assuming you have a database connection
$servername = "localhost"; // Change the port as needed
$username = "root";
$password = "";
$dbname = "admin_login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Verify the hashed password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect to the homepage
            header("Location: homepage.php");
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
