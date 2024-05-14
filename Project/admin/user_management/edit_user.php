<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
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

        input[type="text"] {
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
            margin-top: 10px;
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
        <h1>Edit User Profile</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
        <?php
        // Include db_connection.php to establish a database connection
        include 'db_connection.php';

        // Connect to the database
        $conn = connectdb();

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get username from the form input
            $username = $_POST['username'];

            // Retrieve user's information from the database based on username
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $fullname = $row['fullname'];
                $email = $row['email'];

                // Render the form with pre-populated values
                echo '
                <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="POST">
                    <div class="form-group">
                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" value="' . $fullname . '" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" value="' . $email . '" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="' . $username . '" required readonly>
                    </div>
                    <button type="submit" class="btn">Save Changes</button>
                </form>';
            } else {
                echo "User not found.";
            }
        }
        ?>
        <a href="../../admin/admin_dashboard.php" class="btn btn-back">Back to Dashboard</a>
    </div>
</body>
</html>
