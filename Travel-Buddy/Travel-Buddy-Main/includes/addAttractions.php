<?php
// Check if the form for adding new attractions is submitted via POST method
if (isset ($_POST['newAttractions'])) {
    
    //  Retrieve form data from POST request
    $DestinationID = $_POST['DestinationID'];
    $Name = $_POST['Name'];
    $Description = $_POST['Description'];
    $Location = $_POST['Location'];
    $AdmissionFee = $_POST['AdmissionFee'];
    $OpeningHours = $_POST['OpeningHours'];
    $ImageURL = $_POST['ImageURL'];

    //  Include the database connection script
    include ('./connect.php');

    //  Prepare SQL query to insert the new attraction into the 'attractions' table
    $query = "INSERT INTO attractions 
              (DestinationID, Name, Description, Location, AdmissionFee, OpeningHours, ImageURL) 
              VALUES 
              ('$DestinationID', '$Name', '$Description', '$Location', '$AdmissionFee', '$OpeningHours', '$ImageURL')";

    // Execute the query using the database connection
    $attraction = mysqli_query($connect, $query);

    //  Check if insertion was successful
    if ($attraction) {
        // If successful, redirect to the destination details page with the given DestinationID
        header("Location: ../admin/destinationDetails.php?DestinationID=" . $DestinationID);
    } else {
        // If query fails, display an error message with MySQL error info
        echo "Failed: " . mysqli_error($connect);
    }

} else {
    // If the script is accessed without submitting the form, show an error message
    echo "You should not be here!";
}
?>
