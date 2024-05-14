<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Bike</title>
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
        <h1>Add New Bike</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bike_name">Bike Name:</label>
                <input type="text" id="bike_name" name="bike_name" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" id="model" name="model" required>
            </div>
            <div class="form-group">
                <label for="specification">Specification:</label>
                <input type="text" id="specification" name="specification" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn">Add Bike</button>
        </form>
        <a href="../../admin/admin_dashboard.php" class="btn btn-back">Back to Dashboard</a>
    </div>

    <?php
    // Include db_connection.php to establish a database connection
    include 'db_connection.php';

    // Specify the upload directory
    $upload_dir = "../../admin/Bike_Management/bike_images/";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to the database
        $conn = connectdb();

        // Retrieve bike details from the form
        $bike_name = $_POST['bike_name'];
        $model = $_POST['model'];
        $specification = $_POST['specification'];
        $price = $_POST['price'];

        // File upload
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = $upload_dir . $image_name;

        // Check if the directory exists, if not, create it
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($image_tmp, $image_path)) {
            // Connect to the database
            $conn = connectdb();

            // SQL query to insert bike into the database
            $sql = "INSERT INTO bikes (bike_name, model, specification, price, image) VALUES ('$bike_name', '$model', '$specification', '$price', '$image_path')";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Bike added successfully.</p>";
            } else {
                echo "<p>Error adding bike: " . mysqli_error($conn) . "</p>";
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            echo "<p>Error uploading image.</p>";
        }
    }
    ?>
</body>

</html>