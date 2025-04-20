<?php
// Establishing connection to the MySQL database using mysqli
$connect = mysqli_connect(
    'sql213.infinityfree.com',      // Hostname of the MySQL server
    'if0_38491058',                 // MySQL username
    'Infinity1101',                 // MySQL password
    'if0_38491058_db_travelwise'   // Name of my database to connect to
);

// Checking if the connection was successful
if (!$connect) {
    // If the connection fails, output an error message and stop further execution
    die("Connection failed: " . mysqli_connect_error());
}
?>
