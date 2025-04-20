<!DOCTYPE html>
<html>

<head>
    <!-- Meta charset and title -->
    <meta charset="UTF-8" />
    <title>Add Attraction</title>

    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
// Include navigation bar from reusable component
include ('../reusables/nav.php');

// Include configuration file for DB or global settings
include ('../includes/config.php');

// Include helper functions (e.g., secure(), redirects)
include ('../includes/functions.php');

// Run security check to ensure the user is logged in
secure();
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Page Title -->
                <h1 class="display-5 mt-4 mb-4">Add Attraction</h1>
            </div>
        </div>

        <?php
        // Check if the 'addAttractions' flag is set in the URL
        if (isset($_GET['addAttractions'])) {
            // Fetch DestinationID from the URL to associate attraction with a destination
            $destinationID = $_GET['DestinationID'];
        }

        // Begin form rendering
        echo '
        <div class="container">
            <div class="row">
                <!-- Form to submit new attraction details -->
                <form action="../includes/addAttractions.php" method="POST">

                    <!-- Hidden field to pass destination ID -->
                    <input type="hidden" name="DestinationID" value="' . $destinationID . '">

                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="Name" name="Name" aria-describedby="Name">
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="Description" name="Description"
                            aria-describedby="Enter Description">
                    </div>

                    <!-- Location Input -->
                    <div class="mb-3">
                        <label for="Location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="Location" name="Location"
                            aria-describedby="Enter Location">
                    </div>

                    <!-- Admission Fee Input -->
                    <div class="mb-3">
                        <label for="AdmissionFee" class="form-label">Admission Fee</label>
                        <input type="decimal" class="form-control" id="AdmissionFee" name="AdmissionFee"
                            aria-describedby="Enter Admission Fee">
                    </div>

                    <!-- Opening Hours Input -->
                    <div class="mb-3">
                        <label for="OpeningHours" class="form-label">Opening Hours</label>
                        <input type="text" class="form-control" id="OpeningHours" name="OpeningHours"
                            aria-describedby="Enter Opening Hours">
                    </div>

                    <!-- Image URL Input -->
                    <div class="mb-3">
                        <label for="ImageURL" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="ImageURL" name="ImageURL"
                            aria-describedby="ImageURL">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-dark" name="newAttractions">Submit</button>
                </form>
            </div>
        </div>
        ';
        ?>
    </div>
</body>

</html>
