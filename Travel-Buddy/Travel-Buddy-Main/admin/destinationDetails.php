<?php
// --- BACKEND SETUP AND SECURITY CHECK ---

// Include database connection and configuration
include ('../includes/connect.php');
include ('../includes/config.php');

// Include shared utility functions
include ('../includes/functions.php');

// Ensure user is authenticated before accessing the page
secure();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META & TITLE -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Dash - Destinations</title>

    <!-- STYLESHEETS -->
    <!-- Bootstrap CSS for responsive layout -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Inline Custom CSS for layout and appearance -->
    <style>
        /* Layout settings */
        body, html {
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        /* Destination info styling */
        .country { color: gray; font-size: 12px; margin-top: -5px; }
        .container { margin: 20px; padding-top: 50px; display: flex; justify-content: center; }
        .banner { background-color: black; color: white; padding: 10px 50px; }
        .header { padding-left: 50px; background-color: #CECECE; color: white; border-radius: 5px; }
        .location { padding: 20px; display: flex; flex-direction: column; justify-content: left; }
        .button-align { display: flex; justify-content: center; }
        .add-more { margin: 50px; }

        /* Card styles for attractions */
        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), 
                        .3s box-shadow, 
                        .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
            cursor: pointer;
        }

        .description { font-size: 30px; }
        .img-sizing { height: 200px; object-fit: cover; }
        .details { display: flex; flex-direction: row; align-items: center; gap: 50px; }
        .card:hover { transform: scale(1.03); box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06); }
        .destination-image { width: 100%; max-height: 400px; object-fit: cover; }
    </style>
</head>

<body>
<?php
// --- PAGE CONTENT STARTS HERE ---

// Include the navigation bar
include ('../includes/nav.php');

// Check if a valid destination ID is passed via GET
if (isset($_GET['DestinationID']) && is_numeric($_GET['DestinationID'])) {
    // Sanitize destination ID to prevent SQL injection
    $destinationID = mysqli_real_escape_string($connect, $_GET['DestinationID']);

    // Retrieve destination details (city, country, description, etc.)
    $destinationQuery = "
        SELECT City, Country, Climate, BestTimeToVisit, Description, ImageURL 
        FROM destination 
        WHERE DestinationID = $destinationID
    ";
    $destinationResult = mysqli_query($connect, $destinationQuery);

    // If the destination is found
    if ($destinationResult && mysqli_num_rows($destinationResult) > 0) {
        // Fetch and store destination data
        $destinationRow = mysqli_fetch_assoc($destinationResult);
        $city = $destinationRow['City'];
        $country = $destinationRow['Country'];
        $Description = $destinationRow['Description'];
        $Climate = $destinationRow['Climate'];
        $BestTimeToVisit = $destinationRow['BestTimeToVisit'];
        $ImageURL = $destinationRow['ImageURL'];

        // Display destination heading
        echo '<div class="row">
                <div class="col">
                    <h1 class="display-5 mt-4 mb-4 banner">Destination: ' . htmlspecialchars($city) . ', ' . htmlspecialchars($country) . '</h1>';

        // Display image if available
        if (!empty($ImageURL)) {
            echo '<img src="' . htmlspecialchars($ImageURL) . '" class="destination-image mb-4" alt="Destination Image">';
        }

        // Show climate, best time to visit, and description
        echo '<div class="container location">
                <div>
                    <p class="description">' . htmlspecialchars($Description) . '</p>
                </div>
                <div class="details">
                    <h5>Current climate:</h5> 
                    <p>' . htmlspecialchars($Climate) . '</p>
                </div>
                <div class="details">
                    <h5>Best Time To Visit:</h5> 
                    <p>' . htmlspecialchars($BestTimeToVisit) . '</p>
                </div>
            </div>
        </div>
    </div>';
    } else {
        echo "<p>Destination not found.</p>";
    }

    // --- RETRIEVE ATTRACTIONS FOR THIS DESTINATION ---

    $query = "
        SELECT attractions.* 
        FROM attractions 
        INNER JOIN destination 
        ON attractions.DestinationID = destination.DestinationID
        WHERE attractions.DestinationID = $destinationID
    ";
    $results = mysqli_query($connect, $query);

    // Display attractions if found
    if ($results && mysqli_num_rows($results) > 0) {
        echo '<div class="header">
                <h2 class="display-6">Top attractions at this location</h2>
              </div>';
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';

        // Loop through each attraction and display in a card
        while ($result = mysqli_fetch_assoc($results)) {
            echo '
            <div class="col">
                <div class="card h-100">
                    <img src="' . htmlspecialchars($result['ImageURL']) . '" class="card-img-top img-sizing img-fluid" alt="attraction image">
                    <div class="card-body">
                        <h4 class="card-title">' . htmlspecialchars($result['Name']) . '</h4>
                        <p class="card-title country">' . htmlspecialchars($result['Location']) . '</p>
                        <p class="card-text">' . htmlspecialchars($result['Description']) . '</p>
                        <p class="card-text"><strong>Opening Hours:</strong> ' . htmlspecialchars($result['OpeningHours']) . '</p>
                        <p class="card-text"><strong>Admission Fee:</strong> $' . htmlspecialchars($result['AdmissionFee']) . '</p>
                        
                        <!-- Delete Button -->
                        <div class="deleteBtn">
                            <form method="GET" action="../includes/deleteAttraction.php">
                                <input type="hidden" name="AttractionID" value="' . htmlspecialchars($result['AttractionID']) . '">
                                <button type="submit" name="deleteAttraction" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
        }
        echo '</div>'; // End of attractions grid
    } else {
        echo "<p>No attractions available for this destination.</p>";
    }

    // --- BUTTON TO ADD A NEW ATTRACTION ---
    echo '
    <div class="button-align">
        <form method="GET" action="./newattraction.php">
            <input type="hidden" name="DestinationID" value="' . htmlspecialchars($destinationID) . '">
            <button type="submit" name="addAttractions" class="btn btn-dark add-more">Add New Attraction</button>
        </form>
    </div>';

} else {
    // If DestinationID is missing or invalid
    echo "<p>You should not be here!</p>";
}
?>
</body>
</html>
