<?php
// Include the database connection file
include ('../includes/connect.php');

// Check if the form is submitted with 'updateAttraction' button
if (isset ($_POST['updateAttraction'])) {

    // Retrieve all the form input values sent via POST request
    $AttractionID = $_POST['AttractionID'];           // Unique ID of the attraction to be updated
    $DestinationID = $_POST['DestinationID'];         // Updated Destination ID to which this attraction belongs
    $Name = $_POST['Name'];                           // Updated name of the attraction
    $Description = $_POST['Description'];             // Updated description of the attraction
    $Location = $_POST['Location'];                   // Updated location of the attraction
    $AdmissionFee = $_POST['AdmissionFee'];           // Updated admission fee
    $OpeningHours = $_POST['OpeningHours'];           // Updated opening hours
    $ImageURL = $_POST['ImageURL'];                   // Updated image URL for the attraction

    // SQL query to update the attraction record in the database
    $query = "UPDATE attractions 
              SET DestinationID='$DestinationID', 
                  Name='$Name', 
                  Description='$Description', 
                  Location='$Location', 
                  AdmissionFee='$AdmissionFee', 
                  OpeningHours='$OpeningHours', 
                  ImageURL='$ImageURL' 
              WHERE AttractionID='$AttractionID'";

    // Execute the query and check if it's successful
    $attraction = mysqli_query($connect, $query);

    if ($attraction) {
        // If update is successful, redirect to the attractions admin page
        header("Location: ../admin/attractions.php");
    } else {
        // If update fails, show the error
        echo "Error" . mysqli_error($connect);
    }

} else {
    // If the script is accessed without submitting the form, show a message
    echo "You shouldn't be here!";
}

// Close the database connection
mysqli_close($connect);
?>
