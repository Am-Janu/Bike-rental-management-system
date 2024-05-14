<?php
// Include db_connection.php to establish a database connection
include 'db_connection.php';

// Check if the bike ID is provided in the URL
if(isset($_GET['bike_id'])) {
    // Get the bike ID from the URL
    $bike_id = $_GET['bike_id'];

    // Connect to the database
    $conn = connectdb();

    // SQL query to delete bike from the database
    $sql_delete = "DELETE FROM bikes WHERE id = $bike_id";

    // Execute the query
    if(mysqli_query($conn, $sql_delete)) {
        echo "Bike deleted successfully.";
    } else {
        echo "Error deleting bike: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Bike ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Bike</title>
    <style>
     body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

a {
    display: block; 
    margin-top: 10px;
    text-align: center;
    text-decoration: none;
    color: #333;
}

a:hover {
    color: #000;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Bike</h1>
        <a href="../../admin/admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
