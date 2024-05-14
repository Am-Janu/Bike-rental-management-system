<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px; /* Add spacing */
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

        .btn-back {
            background-color: #ccc;
            color: #333;
        }

        .btn-back:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reset Password</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>

        <div class="message">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Include db_connection.php to establish a database connection
                include 'db_connection.php';

                // Connect to the database
                $conn = connectdb();

                $username = $_POST['username'];
                $new_password = $_POST['new_password'];

                // Update user's password
                $sql = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
                if (mysqli_query($conn, $sql)) {
                    echo "Password reset successfully.";
                } else {
                    echo "Error resetting password: " . mysqli_error($conn);
                }

                // Close the database connection
                mysqli_close($conn);
            }
            ?>
        </div>
        <a href="../../admin/admin_dashboard.php" class="btn btn-back">Back to dashboard</a>
    </div>
</body>
</html>
