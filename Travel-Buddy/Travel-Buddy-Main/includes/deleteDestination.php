<?php
// Include configuration and utility functions
include ('../includes/config.php');
include ('../includes/functions.php');

// Call the secure() function to ensure the user is authenticated
secure();

// Uncomment this line to debug and see the posted DestinationID
// echo $_POST['DestinationID'];die;

// Check if the form has submitted the 'DestinationID'
if (isset($_POST['DestinationID'])) {
    // Retrieve the DestinationID from the POST request
    $DestinationID = $_POST['DestinationID'];

    // Include database connection file
    include ('../includes/connect.php');

    // Prepare a SQL query to delete the destination by its ID
    $query = "DELETE FROM destination WHERE `DestinationID`='$DestinationID'";

    // Execute the query
    $destination = mysqli_query($connect, $query);

    // If the deletion is successful, redirect to the destination admin page
    if ($destination) {
        header("Location: ../admin/destination.php");
    } else {
        // If deletion fails, output the error message
        echo "Failed" . mysqli_error($connect);
    }
} else {
    // If the DestinationID was not provided, show an access warning
    echo "You should not be here!";
}
?>
