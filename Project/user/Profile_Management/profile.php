<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
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
        .profile-box {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .profile-details {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <label for="identifier">Enter Username or Email:</label>
        <input type="text" id="identifier" name="identifier" required>
        <input type="submit" value="Show Profile">
    </form>

    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'db_connection.php';

        // Establish database connection
        $conn = connectdb();

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the input from the form
        $identifier = $_POST['identifier'];

        // SQL query to fetch user details based on username or email
        $sql = "SELECT * FROM users WHERE username = '$identifier' OR email = '$identifier'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Output user details
            echo "<div class='profile-box'>";
            echo "<h2>User Profile</h2>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='profile-details'>";
                echo "User ID: " . $row["id"] . "<br>";
                echo "Username: " . $row["username"] . "<br>";
                echo "Email: " . $row["email"] . "<br>";
                echo "Password: " . $row["password"] . "<br>";
                echo "Status: " . $row["status"] . "<br>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No user found.";
        }

        // Close database connection
        mysqli_close($conn);
    }
    ?>
</body>
</html>
