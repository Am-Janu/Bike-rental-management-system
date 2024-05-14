<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Bikes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        main {
            padding: 0 20px;
        }
        .bike-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .bike-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
            width: 300px;
        }
        .bike-card:hover {
            transform: translateY(-5px);
        }
        .bike-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .bike-info {
            padding: 20px;
        }
        .bike-info h2 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .bike-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Our Bikes</h1>
    </header>
    <main>
        <div class="bike-container">
            <!-- Bike listings will be displayed here -->
            <?php
            include 'db_connection.php';

            // Establish database connection
            $conn = connectdb();

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch bikes from the database
            $sql = "SELECT * FROM bikes";
            $result = mysqli_query($conn, $sql);

            // Check if any bikes are found
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="bike-card">';
                    echo '<img class="bike-img" src="' . $row['image'] . '" alt="' . $row['bike_name'] . '">';
                    echo '<div class="bike-info">';
                    echo '<h2>' . $row['bike_name'] . '</h2>';
                    echo '<p>Model: ' . $row['model'] . '</p>';
                    echo '<p>Specification: ' . $row['specification'] . '</p>';
                    echo '<p>Price: ' . $row['price'] . ' Rs Per day</p>';
                    echo '</div>'; // close .bike-info
                    echo '</div>'; // close .bike-card
                }
            } else {
                echo "No bikes available.";
            }

            // Close database connection
            mysqli_close($conn);
            ?>
        </div> <!-- close .bike-container -->
    </main>
</body>
</html>
