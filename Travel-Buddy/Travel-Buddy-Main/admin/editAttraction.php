<?php
// Get the DestinationID and AttractionID from the URL parameters
$DestinationID = $_GET['DestinationID'];
$AttractionID = $_GET['AttractionID'];

// Include the database connection file
include("../includes/connect.php");

// Query to fetch details of the selected attraction based on AttractionID
$query = "SELECT * FROM attractions WHERE `AttractionID` = '$AttractionID'";
$attractions = mysqli_query($connect, $query);
$result = $attractions->fetch_assoc(); // Get result as an associative array

// Query to fetch all destinations to populate the dropdown menu
$queryforDestination = "SELECT * FROM destination";
$destinations = mysqli_query($connect, $queryforDestination);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- HTML Meta Tags and Bootstrap -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Attraction</title>
    <!-- Bootstrap 4.5.2 CDN for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Main container for the update attraction form -->
    <div class="container">
        <!-- Page Title -->
        <div class="row">
            <div class="col">
                <h1 class="display-5 mt-4 mb-4">Update Attraction</h1>
            </div>
        </div>

        <!-- Form for updating attraction -->
        <div class="row">
            <div class="col">
                <form method="POST" action="../includes/updateAttraction.php">
                    <!-- Hidden field to hold AttractionID (used in update operation) -->
                    <input type="hidden" name="AttractionID" value="<?php echo $result['AttractionID']; ?>">

                    <!-- Dropdown to select destination; the current destination is pre-selected -->
                    <div class="mb-3">
                        <label for="DestinationID" class="form-label">Destination</label>
                        <select name="DestinationID" id="DestinationID" class="form-control">
                            <?php foreach ($destinations as $destination): ?>
                                <option value="<?php echo $destination['DestinationID']; ?>" 
                                    <?php if ($destination['DestinationID'] == $result['DestinationID']): ?>
                                        selected="selected"
                                    <?php endif; ?>>
                                    <?php echo $destination['City']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Input fields for attraction attributes -->
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="Name" name="Name"
                            value="<?php echo $result['Name']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="Description" name="Description"
                            value="<?php echo $result['Description']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="Location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="Location" name="Location"
                            value="<?php echo $result['Location']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="OpeningHours" class="form-label">Opening Hours</label>
                        <input type="text" class="form-control" id="OpeningHours" name="OpeningHours"
                            value="<?php echo $result['OpeningHours']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="AdmissionFee" class="form-label">Admission Fee</label>
                        <input type="decimal" class="form-control" id="AdmissionFee" name="AdmissionFee"
                            value="<?php echo $result['AdmissionFee']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="ImageURL" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="ImageURL" name="ImageURL"
                            value="<?php echo $result['ImageURL']; ?>">
                    </div>

                    <!-- Submit button to update the attraction record -->
                    <button type="submit" name="updateAttraction" class="btn btn-primary">Update Attraction</button>
                </form>
            </div>
        </div>

    </div>

</body>

</html>
