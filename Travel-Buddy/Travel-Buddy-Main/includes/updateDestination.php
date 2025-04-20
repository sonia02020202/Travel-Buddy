<?php
// Include the database connection script
include ('../includes/connect.php');

// Check if the form for updating a destination has been submitted
if (isset ($_POST['updateDestination'])) {
    
    // Retrieve the form data sent via POST request
    $DestinationID = $_POST['DestinationID'];
    $City = $_POST['City'];
    $Country = $_POST['Country'];
    $Description = $_POST['Description'];
    $Climate = $_POST['Climate'];
    $BestTimeToVisit = $_POST['BestTimeToVisit'];
    $ImageURL = $_POST['ImageURL'];

    // Construct an SQL query to update the destination record based on the provided DestinationID
    $query = "UPDATE destination 
              SET City='$City', 
                  Country='$Country', 
                  Description='$Description', 
                  Climate='$Climate', 
                  BestTimeToVisit='$BestTimeToVisit', 
                  ImageURL='$ImageURL' 
              WHERE DestinationID='$DestinationID'";

    // Execute the update query
    $destination = mysqli_query($connect, $query);

    // If the query was successful, redirect to the admin destination page
    if ($destination) {
        header("Location: ../admin/destination.php");
    } else {
        // If an error occurs, display the error message
        echo "Error" . mysqli_error($connect);
    }

} else {
    // If the form wasn't submitted properly, show a warning message
    echo "You shouldn't be here!";
}

// Close the database connection
mysqli_close($connect);
