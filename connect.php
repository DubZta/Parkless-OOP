<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Change this if you have a different MySQL username
$password = "";     // Change this if you have a different MySQL password
$database = "parkless_user";

// Establish the connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($pass !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password for security
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO userdb (email, username, pass) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $username, $pass);

    if ($stmt->execute()) {
        // echo "Registration successful!";
        // Registration successful - redirect to login page
        header("Location: index.html"); // Replace "index.php" with the login page URL
        exit; // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
