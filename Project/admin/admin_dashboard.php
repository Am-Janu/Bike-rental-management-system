<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
            color: #333;
        }

        .admin-options {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-section {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .admin-section:hover {
            transform: translateY(-5px);
        }

        .admin-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .admin-options ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .admin-options li {
            margin-bottom: 10px;
        }

        .admin-options li a {
            display: block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .admin-options li a:hover {
            background-color: #0056b3;
        }

        .logout-link {
            display: block;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            text-align: center;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
        }

        .logout-link:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <div class="admin-options">
            <div class="admin-section" style="background-color: #ffeaa7;">
                <h2>User Management</h2>
                <ul>
                    <li><a href="user_management/create_user.php">Create New User</a></li>
                    <li><a href="user_management/view_users.php">View Users</a></li>
                    <li><a href="user_management/edit_user.php">Edit User Profiles</a></li>
                    <li><a href="user_management/deactivate_user.php">Deactivate/Delete Users</a></li>
                    <li><a href="user_management/reset_password.php">Reset User Password</a></li>
                </ul>
            </div>
            <div class="admin-section" style="background-color: #ff7675;">
                <h2>Bike Management</h2>
                <ul>
                    <li><a href="Bike_Management/add_bike.php">Add New Bike</a></li>
                    <li><a href="Bike_Management/edit_bike.php">Edit Bike Details</a></li>
                    <li><a href="Bike_Management/remove_bike.php">Remove Bike</a></li>
                    <li><a href="Bike_Management/view_bikes.php">View Bikes</a></li>
                    <li><a href="Bike_Management/track_bike.php">Track Bike Availability</a></li>
                </ul>
            </div>
            <div class="admin-section" style="background-color: #74b9ff;">
                <h2>Booking Management</h2>
                <ul>
                    <li><a href="Booking_Management/view_bookings.php">View Bookings</a></li>
                    <li><a href="Booking_Management/approve_booking.php">Approve/Reject Bookings</a></li>
                </ul>
            </div>
        </div>
        <a class="logout-link" href="../Index.html">Logout</a>
    </div>
</body>

</html>