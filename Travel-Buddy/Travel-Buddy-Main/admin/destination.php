<?php
// Including database connection and configuration files
include ('../includes/connect.php');
include ('../includes/config.php');
include ('../includes/functions.php');

// Securing the page - only accessible to authenticated users
secure();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Page metadata and title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Dash - Destinations</title>

    <!-- Bootstrap CSS for layout and styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Custom inline CSS styles -->
    <style>
        /* Style for country text */
        .country {
            color: gray;
            font-size: 12px;
            margin-top: -5px;
        }

        /* Card styling for destinations */
        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow;
            cursor: pointer;
        }

        /* Hover effect on cards */
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

        /* Button layout */
        .buttons {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    <!-- Navigation bar inclusion -->
    <?php include ('../includes/nav.php') ?>

    <!-- Main content container -->
    <div class="container">
        <!-- Page heading -->
        <div class="row">
            <div class="col">
                <h1 class="display-5 mt-4 mb-4">Admin: Manage Destinations</h1>
            </div>
        </div>

        <!-- Button to add new destination -->
        <div class="button-align mb-3">
            <form method="GET" action="newdestination.php">
                <button type="submit" name="addDestination" class="btn btn-dark add-more">Add More</button>
            </form>
        </div>

        <?php
        // SQL query to fetch destinations in descending order of ID
        $sql = "SELECT * FROM destination ORDER BY DestinationID DESC ";
        $result = mysqli_query($connect, $sql);

        // Check if any destinations were found
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<div class="row row-cols-1 row-cols-md-2 g-4">';
            // Loop through each destination record
            while ($destination = mysqli_fetch_assoc($result)) {
                echo '
                <div class="col">
                    <div class="card">
                        <!-- Destination image -->
                        <img src="' . htmlspecialchars($destination['ImageURL']) . '" class="card-img-top img-sizing img-fluid" alt="destination image" style="width: 100%; height: 200px; object-fit: cover;">

                        <!-- Destination details -->
                        <div class="card-body">
                            <h4 class="card-title">' . htmlspecialchars($destination['City']) . '</h4>
                            <h6 class="card-title country">' . htmlspecialchars($destination['Country']) . '</h6>
                            <p class="card-text">' . htmlspecialchars($destination['Description']) . '</p>

                            <!-- Action buttons: View, Delete, Update -->
                            <div class="buttons">
                                <!-- View More Button -->
                                <form method="GET" action="destinationDetails.php">
                                    <input type="hidden" name="DestinationID" value="' . htmlspecialchars($destination['DestinationID']) . '">
                                    <button type="submit" name="details" class="btn btn-dark">View More</button>
                                </form>
                                
                                <!-- Delete Button with confirmation -->
                                <form method="POST" action="../includes/deleteDestination.php" onsubmit="return confirm(\'Are you sure you want to delete this destination?\');">
                                    <input type="hidden" name="DestinationID" value="' . htmlspecialchars($destination['DestinationID']) . '">
                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                </form>
                                
                                <!-- Update Button -->
                                <form method="GET" action="editDestination.php">
                                    <input type="hidden" name="DestinationID" value="' . htmlspecialchars($destination['DestinationID']) . '">
                                    <button type="submit" name="updateDestination" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            echo '</div>'; // End of row layout
        } else {
            // Display message if no destinations are found
            echo '<p>No destinations found.</p>';
        }

        // Closing the database connection
        mysqli_close($connect);
        ?>
    </div> <!-- End of container -->

    <!-- Bootstrap JS bundle for UI functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
