<?php
// Include configuration and utility functions
include ('../includes/config.php');
include ('../includes/functions.php');

// Ensure the user is authenticated and authorized
secure();

// Check if the 'deleteAttraction' parameter exists in the URL
if (isset ($_GET['deleteAttraction'])) {
    
    // Retrieve the AttractionID from the URL
    $AttractionID = $_GET['AttractionID'];
    
    // Include the database connection
    include ('../includes/connect.php');
    
    // Prepare the SQL DELETE query to remove the attraction with the specified ID
    $query = "DELETE FROM attractions WHERE `AttractionID`='$AttractionID'";
    
    // Execute the query
    $destination = mysqli_query($connect, $query);
    
    // If deletion is successful, redirect back to the attractions admin page
    if ($destination) {
        header("Location: ../admin/attractions.php");
    } else {
        // If the query fails, display an error message
        echo "Failed" . mysqli_error($connect);
    }

} else {
    // If the script is accessed incorrectly, show a warning message
    echo "You should not be here!";
}
