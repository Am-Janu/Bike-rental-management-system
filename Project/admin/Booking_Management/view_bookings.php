<?php
// Include database connection
include 'C:\xampp\htdocs\Project\admin\Booking_Management\db_connection.php';

// Fetch bookings from the database
function fetchBookings() {
    $conn = connectdb();
    $sql = "SELECT * FROM bookings";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

// Fetch and display bookings
$bookings = fetchBookings();
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
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>View Bookings</h1>
    <table>
        <tr>
            <th>Booking ID</th>
            <th>User ID</th>
            <th>Bike ID</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($bookings)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['bike_id']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
