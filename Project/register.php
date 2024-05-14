<?php
session_start();

// Establish database connection
$servername = "localhost";
$username = "root"; // Change if you have a different username
$password = ""; // Change if you have a different password
$database = "bikerental";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert user data into database
    $sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$username', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful";
        header("Location: Index.html"); // Redirect to the login page after successful registration
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
