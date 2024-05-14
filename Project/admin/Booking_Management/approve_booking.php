<?php
// Include database connection
include 'C:\xampp\htdocs\Project\admin\Booking_Management\db_connection.php';

// Function to fetch bookings pending for approval
function fetchPendingBookings() {
    $conn = connectdb();
    $sql = "SELECT * FROM bookings WHERE status = 'Pending'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

// Function to approve a booking
function approveBooking($bookingId) {
    $conn = connectdb();
    $sql = "UPDATE bookings SET status = 'Approved' WHERE id = $bookingId";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

// Function to reject a booking
function rejectBooking($bookingId) {
    $conn = connectdb();
    $sql = "UPDATE bookings SET status = 'Rejected' WHERE id = $bookingId";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

// Check if a booking is being approved or rejected
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve'])) {
        $bookingId = $_POST['booking_id'];
        if (approveBooking($bookingId)) {
            echo "Booking approved successfully.";
        } else {
            echo "Error approving booking.";
        }
    } elseif (isset($_POST['reject'])) {
        $bookingId = $_POST['booking_id'];
        if (rejectBooking($bookingId)) {
            echo "Booking rejected successfully.";
        } else {
            echo "Error rejecting booking.";
        }
    }
}

// Fetch pending bookings
$pendingBookings = fetchPendingBookings();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve/Reject Bookings</title>
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

        .btn {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Approve/Reject Bookings</h1>
    <table>
        <tr>
            <th>Booking ID</th>
            <th>User ID</th>
            <th>Bike ID</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($pendingBookings)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['bike_id']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                    <button class="btn" type="submit" name="approve">Approve</button>
                    <button class="btn" type="submit" name="reject">Reject</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
