<?php
// Include db_connection.php to establish a database connection
include 'db_connection.php';

// Connect to the database
$conn = connectdb();

// SQL query to fetch available bikes from the database
$sql = "SELECT * FROM bikes WHERE available = true";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are any available bikes
if(mysqli_num_rows($result) > 0) {
    echo "<h1>Available Bikes</h1>";
    // Display a table to show available bike details
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Bike Name</th><th>Model</th><th>Specification</th><th>Price</th><th>Image</th></tr>";
    // Fetch and display each available bike's details
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['bike_name']."</td>";
        echo "<td>".$row['model']."</td>";
        echo "<td>".$row['specification']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td><img src='".$row['image']."' width='100'></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No available bikes found.";
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Bike Availability</title>
    <style>
     body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
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

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

img {
    display: block;
    margin: 0 auto;
}
    </style>
</head>
<body>
    <div class="container">
        <a href="../../admin/admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
