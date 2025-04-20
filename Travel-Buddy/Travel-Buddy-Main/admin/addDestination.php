<?php
// Check if the form for adding new destinations is submitted
if (isset($_POST['newDestination'])) {
    
    //  Retrieve input values from the submitted form
    $City = $_POST['City'];
    $Country = $_POST['Country'];
    $Description = $_POST['Description'];
    $Climate = $_POST['Climate'];
    $BestTimeToVisit = $_POST['BestTimeToVisit'];
    $ImageURL = $_POST['ImageURL'];

    //  Include database connection script
    include('../includes/connect.php');

    // Prepare SQL query to insert the form data into the 'destination' table
    $query = "INSERT INTO destination (City, Country, Description, Climate, BestTimeToVisit, ImageURL) 
              VALUES ('$City', '$Country', '$Description', '$Climate', '$BestTimeToVisit', '$ImageURL')";

    //  Execute the query and insert the destination data
    $destination = mysqli_query($connect, $query);

    // Check if the insert operation was successful
    if ($destination) {
        // If successful, redirect the user to the destination details page
        header("Location: ../destination.php");
    } else {
        // If an error occurs, display the error message
        echo "Failed" . mysqli_error($connect);
    }

} else {
    // If the form was not submitted properly, display a warning message
    echo "You should not be here!";
}
?>
