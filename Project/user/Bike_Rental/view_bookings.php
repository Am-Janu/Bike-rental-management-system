<?php
// Include the database connection file
include 'db_connection.php';

// Function to fetch bookings for a specific user from the database
function fetchBookings($user_id) {
    // Establish database connection
    $conn = connectdb();

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to select bookings for the specified user ID
    $sql = "SELECT * FROM bookings WHERE user_id = '$user_id'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any bookings are found
    if (mysqli_num_rows($result) > 0) {
        // Output data of each booking
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="booking">';
            echo '<p>Booking ID: ' . $row['id'] . '</p>';
            echo '<p>Bike ID: ' . $row['bike_id'] . '</p>';
            echo '<p>Start Date: ' . $row['start_date'] . '</p>';
            echo '<p>End Date: ' . $row['end_date'] . '</p>';
            echo '<p>Status: ' . $row['status'] . '</p>';
            echo '</div>';
        }
    } else {
        echo "No bookings found for user ID: $user_id";
    }

    // Close database connection
    mysqli_close($conn);
}

// Initialize user_id variable
$user_id = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user_id from the form
    $user_id = $_POST['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .booking {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .booking p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>View Bookings</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="user_id">Enter User ID:</label>
        <input type="text" id="user_id" name="user_id" value="<?php echo $user_id; ?>" required>
        <input type="submit" value="View Bookings">
    </form>
    
    <?php
    // If user_id is set, fetch and display bookings
    if (!empty($user_id)) {
        fetchBookings($user_id);
    }
    ?>
</body>
</html>
