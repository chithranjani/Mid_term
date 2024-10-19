<?php
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)
    OR die('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');

$query = "CREATE DATABASE IF NOT EXISTS belt";
mysqli_query($dbc, $query) OR die('Error creating database: ' . mysqli_error($dbc));

mysqli_select_db($dbc, 'belt') OR die('Could not select the database: ' . mysqli_error($dbc));

$query = "CREATE TABLE IF NOT EXISTS belt (
    BeltID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    BeltName VARCHAR(255) NOT NULL,
    BeltDescription TEXT NOT NULL,
    QuantityAvailable INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    ProductAddedBy VARCHAR(255) NOT NULL,
    BeltMaterial VARCHAR(255) NOT NULL 
 )";

$result = mysqli_query($dbc, $query);

?>
