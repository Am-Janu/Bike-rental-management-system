<?php

// Check if the function exists before declaring it
if (!function_exists('connectdb')) {
    // Declare the connectdb function
    function connectdb()
    {
        $HOST = "localhost";
        $USER = "root";
        $PASSWORD = "";
        $DB = "bikerental";

        $con = mysqli_connect($HOST, $USER, $PASSWORD, $DB);

        if ($con) {
            echo "DB Connected Successfully...!";
        } else {
            echo "DB Connection Failed...!";
        }

        return $con;
    }
}

?>
