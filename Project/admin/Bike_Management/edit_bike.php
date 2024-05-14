<?php
// Include db_connection.php to establish a database connection
include 'db_connection.php';

// Initialize variables to store bike details
$bike_name = $model = $specification = $price = '';

// Check if the bike ID is provided in the URL
if(isset($_GET['bike_id'])) {
    // Get the bike ID from the URL
    $bike_id = $_GET['bike_id'];

    // Connect to the database
    $conn = connectdb();

    // SQL query to fetch bike details based on ID
    $sql = "SELECT * FROM bikes WHERE id = $bike_id";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if(mysqli_num_rows($result) > 0) {
        // Fetch the bike details
        $row = mysqli_fetch_assoc($result);
        $bike_name = $row['bike_name'];
        $model = $row['model'];
        $specification = $row['specification'];
        $price = $row['price'];
    } else {
        // Bike not found
        echo "Bike not found.";
    }

    // Close the database connection
    mysqli_close($conn);
}

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = connectdb();

    // Retrieve bike details from the form
    $bike_name = $_POST['bike_name'];
    $model = $_POST['model'];
    $specification = $_POST['specification'];
    $price = $_POST['price'];

    // Get the bike ID from the URL
    $bike_id = $_GET['bike_id'];

    // File upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_directory = "images/";
    $image_path = $image_directory . $image_name;

    // Check if the directory exists, if not, create it
    if (!file_exists($image_directory)) {
        mkdir($image_directory, 0777, true); // Creates the directory recursively
    }

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($image_tmp, $image_path)) {
        // SQL query to update bike details in the database
        $sql_update = "UPDATE bikes SET bike_name='$bike_name', model='$model', specification='$specification', price='$price', image='$image_path' WHERE id=$bike_id";

        if(mysqli_query($conn, $sql_update)) {
            echo "Bike details updated successfully.";
        } else {
            echo "Error updating bike details: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading image.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bike Details</title>
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

button[type="submit"] {
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

button[type="submit"]:hover {
    background-color: #0056b3;
}

a {
    display: block;
    margin-top: 10px;
    text-align: center;
    text-decoration: none;
    color: #333;
}

a:hover {
    color: #000;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Bike Details</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?bike_id=' . $bike_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bike_name">Bike Name:</label>
                <input type="text" id="bike_name" name="bike_name" value="<?php echo $bike_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" id="model" name="model" value="<?php echo $model; ?>" required>
            </div>
            <div class="form-group">
                <label for="specification">Specification:</label>
                <input type="text" id="specification" name="specification" value="<?php echo $specification; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $price; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <!-- Add more fields as needed -->
            <button type="submit">Save Changes</button>
        </form>
        <a href="../../admin/admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
