<?php

// Replace with your RDS hostname, port, username, and password
$rds_hostname = 'rsm-leaderboard-scrape.cugmb3gql3w9.us-east-1.rds.amazonaws.com';
$rds_port = 3306;
$rds_username = 'admin';
$rds_password = 'test1234';
$rds_db_name = 'rsm-leaderboard-scrape';

// Connect to the RDS MySQL database
$mysqli = new mysqli($rds_hostname, $rds_username, $rds_password, $rds_db_name, $rds_port);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Perform a SQL query
$result = $mysqli->query('SELECT * FROM leaderboard_rsm');

// Fetch the results
while ($row = $result->fetch_assoc()) {
    // Process the row data
}

// Close the connection
$mysqli->close();

?>
This code creates a MySQLi object and uses it to connect to the RDS MySQL database using the hostname, port, username, and password that you provide. It then performs a SQL query and fetches the results, and finally closes the connection to the database.

It's worth noting that you should make sure to use prepared statements and parameterized queries to prevent SQL injection attacks, and you should also handle any errors that may occur during the database connection and query process.




