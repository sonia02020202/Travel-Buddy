<?php
// Check if the form for adding new destinations is submitted
if (isset($_POST['newDestination'])) {

    // Retrieve data from the form fields submitted via POST
    $City = $_POST['City'];
    $Country = $_POST['Country'];
    $Description = $_POST['Description'];
    $Climate = $_POST['Climate'];
    $BestTimeToVisit = $_POST['BestTimeToVisit'];
    $ImageURL = $_POST['ImageURL'];

    // Include the database connection file
    include ('../includes/connect.php');

    // SQL query to insert a new record into the 'destination' table
    $query = "INSERT INTO destination (City, Country, Description, Climate, BestTimeToVisit, ImageURL) 
              VALUES ('$City', '$Country', '$Description', '$Climate', '$BestTimeToVisit', '$ImageURL')";

    // Execute the SQL query
    $destination = mysqli_query($connect, $query);

    // Check if the query executed successfully
    if ($destination) {
        // Redirect user to the destination admin page after successful insertion
        header("Location: ../admin/destination.php");
    } else {
        // Show an error message if query execution failed
        echo "Failed" . mysqli_error($connect);
    }

} else {
    // Show a warning message if the script is accessed without form submission
    echo "You should not be here!";
}
?>
