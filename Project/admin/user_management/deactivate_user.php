<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deactivate User</title>
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

        .message {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Deactivate User</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="id" placeholder="Enter User ID" required>
            <button type="submit" class="btn">Deactivate User</button>
        </form>

        <div class="message">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
                // Include db_connection.php to establish a database connection
                include 'db_connection.php';

                // Connect to the database
                $conn = connectdb();

                $user_id = $_GET['id'];

                // Check if ID parameter is set
                if (!empty($user_id)) {
                    // Update user status to deactivated
                    $sql = "UPDATE users SET status = 'Deactivated' WHERE id = $user_id";
                    if (mysqli_query($conn, $sql)) {
                        echo "User deactivated successfully.";
                    } else {
                        echo "Error deactivating user: " . mysqli_error($conn);
                    }
                } else {
                    echo "User ID not provided.";
                }

                // Close the database connection
                mysqli_close($conn);
            }
            ?>
        </div>

        <a href="view_users.php" class="btn">Back to User List</a>
    </div>
</body>
</html>
