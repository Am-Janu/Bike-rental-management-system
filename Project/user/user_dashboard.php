<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 20px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        .card-body {
            padding: 20px;
        }

        .card-body ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .card-body li {
            margin-bottom: 10px;
        }

        .card-body a {
            display: block;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .card-body a:hover {
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
    </style>
</head>

<body>
    <h1>Welcome to User Dashboard</h1>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Profile Management</h2>
            </div>
            <div class="card-body">
                <ul>
                    <li><a href="Profile_Management/profile.php">View Profile</a></li>
                    <li><a href="Profile_Management/edit_profile.php">Edit Profile</a></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2>Bike Rental</h2>
            </div>
            <div class="card-body">
                <ul>
                    <li><a href="Bike_Rental/browse_bikes.php">Browse Bikes</a></li>
                    <li><a href="Bike_Rental/make_booking.php">Make Booking</a></li>
                    <li><a href="Bike_Rental/view_bookings.php">View Bookings</a></li>
                </ul>
            </div>
        </div>
        <a class="logout-link" href="../Index.html">Logout</a> 
    </div>
</body>

</html>