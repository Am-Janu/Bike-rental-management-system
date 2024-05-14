<?php

function connectdb()
{
    $HOST = "localhost";
    $USER = "root";
    $PASSWORD = "";
    $DB = "bikerental";

    $con = mysqli_connect($HOST, $USER, $PASSWORD, $DB);

    if ($con) 
    {
        echo "DB Connected Successfully...!";
    } else 
    {
        echo "DB Connection Failed...!";
    }

    return $con;
}
?>
