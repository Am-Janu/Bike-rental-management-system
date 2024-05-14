<?php
// Include the database connection file
include 'db_connection.php';

// Fetch available bikes from the database
function fetchAvailableBikes() {
    // Establish database connection
    $conn = connectdb();

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to select available bikes
    $sql = "SELECT * FROM bikes WHERE available = true";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any bikes are found
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id'] . '">' . $row['bike_name'] . '</option>';
        }
    } else {
        echo '<option value="" disabled>No bikes available</option>';
    }

    // Close database connection
    mysqli_close($conn);
}

// Function to make a booking
function makeBooking($user_id, $bike_id, $start_date, $end_date) {
    // Establish database connection
    $conn = connectdb();

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to insert booking into the database
    $sql = "INSERT INTO bookings (user_id, bike_id, start_date, end_date) VALUES ('$user_id', '$bike_id', '$start_date', '$end_date')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Update bike availability status
        $update_sql = "UPDATE bikes SET available = false WHERE id = '$bike_id'";
        mysqli_query($conn, $update_sql);
        
        // Redirect to view bookings page
        header("Location: view_bookings.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input from the form
    $user_id = $_POST['user_id'];
    $bike_id = $_POST['bike_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Make the booking
    makeBooking($user_id, $bike_id, $start_date, $end_date);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Booking</title>
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
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        select {
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
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Make Booking</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" value="" ><br><br>
        <label for="bike_id">Select Bike:</label>
        <select id="bike_id" name="bike_id">
            <?php fetchAvailableBikes(); ?>
        </select><br><br>
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>
        <input type="submit" value="Book Now">
    </form>
</body>
</html>
