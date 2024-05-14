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

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if it's an admin login
    if ($username === "admin" && $password === "admin") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin/admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        // Check if it's a user login
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['user_logged_in'] = true;
            header("Location: user/user_dashboard.php"); // Redirect to user dashboard
            exit();
        } else {
            echo "Invalid username or password";
        }
    }
}

mysqli_close($conn);
