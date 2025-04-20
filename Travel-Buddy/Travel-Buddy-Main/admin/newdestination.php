<!DOCTYPE html>
<html>

<head>
    <!-- Meta and Title -->
    <meta charset="UTF-8" />
    <title>Add Destination</title>
    
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
// Include necessary files for DB connection and authentication
include ('../includes/connect.php');
include ('../includes/config.php');
include ('../includes/functions.php');

// Secure the page – only accessible if user is authenticated
secure();

// Initialize message variables
$errorMessage = '';
$successMessage = '';

// Handle form submission (triggered when form is POSTed with 'newDestination')
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newDestination'])) {
    // Sanitize user input using mysqli_real_escape_string
    $city = mysqli_real_escape_string($connect, $_POST['City']);
    $country = mysqli_real_escape_string($connect, $_POST['Country']);
    $description = mysqli_real_escape_string($connect, $_POST['Description']);
    $climate = mysqli_real_escape_string($connect, $_POST['Climate']);
    $bestTimeToVisit = mysqli_real_escape_string($connect, $_POST['BestTimeToVisit']);
    $imageURL = mysqli_real_escape_string($connect, $_POST['ImageURL']);

    // Validate if any field is left empty
    if (empty($city) || empty($country) || empty($description) || empty($climate) || empty($bestTimeToVisit) || empty($imageURL)) {
        $errorMessage = "All fields are required!";
    } else {
        // Insert destination details into the database
        $sql = "INSERT INTO destination (City, Country, Description, Climate, BestTimeToVisit, ImageURL) 
                VALUES ('$city', '$country', '$description', '$climate', '$bestTimeToVisit', '$imageURL')";

        // Execute query and handle result
        if (mysqli_query($connect, $sql)) {
            $successMessage = "Destination added successfully!";
            header('Location: destination.php'); // Redirect to destination list
            exit();
        } else {
            $errorMessage = "Error: " . mysqli_error($connect); // Show DB error if any
        }
    }
}
?>

<body>
    <div class="container">
        <!-- Page Heading -->
        <div class="row">
            <div class="col">
                <h1 class="display-5 mt-4 mb-4">Add Destination</h1>
            </div>
        </div>

        <!-- Display messages (success or error) -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <!-- Destination Submission Form -->
        <div class="row">
            <div class="col">
                <form action="newdestination.php" method="POST">
                    
                    <!-- City Input -->
                    <div class="mb-3">
                        <label for="City" class="form-label">City</label>
                        <input type="text" class="form-control" id="City" name="City" required>
                    </div>

                    <!-- Country Input -->
                    <div class="mb-3">
                        <label for="Country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="Country" name="Country" required>
                    </div>

                    <!-- Description Textarea -->
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control" id="Description" name="Description" rows="3" required></textarea>
                    </div>

                    <!-- Climate Input -->
                    <div class="mb-3">
                        <label for="Climate" class="form-label">Climate</label>
                        <input type="text" class="form-control" id="Climate" name="Climate" required>
                    </div>

                    <!-- Best Time to Visit Input -->
                    <div class="mb-3">
                        <label for="BestTimeToVisit" class="form-label">Best Time to Visit</label>
                        <input type="text" class="form-control" id="BestTimeToVisit" name="BestTimeToVisit" required>
                    </div>

                    <!-- Image URL Input -->
                    <div class="mb-3">
                        <label for="ImageURL" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="ImageURL" name="ImageURL" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="newDestination" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional Bootstrap JS for interactive components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
