<?php
// Get the DestinationID from the URL using GET method
$DestinationID = $_GET['DestinationID'];

// Include the database connection file
include ("../includes/connect.php");

// SQL query to fetch the destination details using the DestinationID
$query = "SELECT * FROM destination WHERE `DestinationID` = '$DestinationID'";
$destinations = mysqli_query($connect, $query);

// Fetch the first row of result as an associative array
$result = $destinations->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character encoding and responsive layout -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page Title -->
    <title>Update Destination</title>
    
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Page Heading -->
        <div class="row">
            <div class="col">
                <h1 class="display-5 mt-4 mb-4">Update Destination</h1>
            </div>
        </div>

        <!-- Form to update destination data -->
        <div class="row">
            <div class="col">
                <!-- The form uses POST method and submits to updateDestination.php -->
                <form method="POST" action="../includes/updateDestination.php">

                    <!-- Hidden field to pass DestinationID -->
                    <input type="hidden" name="DestinationID" value="<?php echo $result['DestinationID']; ?>">

                    <!-- Input field for City -->
                    <div class="mb-3">
                        <label for="City" class="form-label">City</label>
                        <input type="text" class="form-control" id="City" name="City" aria-describedby="City"
                            value="<?php echo $result['City']; ?>">
                    </div>

                    <!-- Input field for Country -->
                    <div class="mb-3">
                        <label for="Country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="Country" name="Country" aria-describedby="Country"
                            value="<?php echo $result['Country']; ?>">
                    </div>

                    <!-- Input field for Description -->
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="Description" name="Description"
                            aria-describedby="Enter Description" value="<?php echo $result['Description']; ?>">
                    </div>

                    <!-- Input field for Climate -->
                    <div class="mb-3">
                        <label for="Climate" class="form-label">Climate</label>
                        <input type="text" class="form-control" id="Climate" name="Climate"
                            aria-describedby="Enter Climate" value="<?php echo $result['Climate']; ?>">
                    </div>

                    <!-- Input field for Best Time To Visit -->
                    <div class="mb-3">
                        <label for="BestTimeToVisit" class="form-label">Best time to visit</label>
                        <input type="text" class="form-control" id="BestTimeToVisit" name="BestTimeToVisit"
                            aria-describedby="BestTimeToVisit" value="<?php echo $result['BestTimeToVisit']; ?>">
                    </div>

                    <!-- Input field for Image URL -->
                    <div class="mb-3">
                        <label for="ImageURL" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="ImageURL" name="ImageURL"
                            aria-describedby="ImageURL" value="<?php echo $result['ImageURL']; ?>">
                    </div>

                    <!-- Submit button to update destination -->
                    <button type="submit" name="updateDestination" class="btn btn-primary">Update Destination</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
