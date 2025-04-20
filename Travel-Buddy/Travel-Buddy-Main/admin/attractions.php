<?php
// Include the necessary backend configuration files
include ('../includes/connect.php');  // Database connection
include ('../includes/config.php');   // Site-wide configuration (e.g., constants, URLs)
include ('../includes/functions.php'); // Utility functions (e.g., secure login check)
secure(); // Ensure only logged-in users (e.g., admin) can access this page
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page title -->
    <title>Discover Dash - Attractions</title>
    
    <!-- Bootstrap CSS for styling and layout -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <!-- Custom CSS for attraction cards -->
    <style>
        .country {
            color: gray;
            font-size: 12px;
            margin-top: -5px;
        }

        .buttons {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12),
                        .3s box-shadow,
                        .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
            cursor: pointer;
        }

        .img-sizing {
            height: 200px;
            object-fit: cover; /* Keep image ratio within box */
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12),
                        0 4px 8px rgba(0, 0, 0, .06);
        }
    </style>
</head>

<body>
    <!-- Include the navigation bar -->
    <?php include ('../includes/nav.php') ?>

    <!-- Main content container -->
    <div class="container">
        <!-- Page heading -->
        <div class="row">
            <div class="col">
                <h1 class="display-5 mt-4 mb-4">Admin: Manage Attractions</h1>
            </div>
        </div>

        <?php
        // Query to fetch all attractions from the database
        $query = 'SELECT * FROM attractions';
        $attractions = mysqli_query($connect, $query); // Run query

        // Error check for database connection
        if (mysqli_connect_error()) {
            die ("Connection error: " . mysqli_connect_error());
        }

        // Start Bootstrap row for attraction cards
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';

        // Loop through each attraction and display as a card
        foreach ($attractions as $attraction) {
            echo '
            <div class="col">
                <div class="card h-100">
                    <!-- Attraction image -->
                    <img src="' . $attraction['ImageURL'] . '" class="card-img-top img-sizing img-fluid" alt="destination image">
                    
                    <!-- Card body with attraction details -->
                    <div class="card-body">
                        <h4 class="card-title">' . $attraction['Name'] . '</h4>
                        <p class="card-title country">' . $attraction['Location'] . '</p>
                        <p class="card-text">' . $attraction['Description'] . '</p>
                        <p class="card-text"><strong>Opening Hours:</strong> ' . $attraction['OpeningHours'] . '</p>
                        <p class="card-text"><strong>Admission Fee:</strong> $' . $attraction['AdmissionFee'] . '</p>
                    </div>

                    <!-- Action buttons: Delete and Update -->
                    <div class="buttons">         
                        <!-- Delete button inside form -->
                        <div class="deleteBtn">
                            <form method="GET" action="../includes/deleteAttraction.php">
                                <input type="hidden" name="AttractionID" value="' . $attraction['AttractionID'] . '">
                                <button type="submit" name="deleteAttraction" class="btn btn-danger">Delete</button>
                            </form>
                        </div>

                        <!-- Update button inside form -->
                        <form method="GET" action="editAttraction.php">
                            <!-- Hidden fields to pass IDs -->
                            <input type="hidden" name="AttractionID" value="' . $attraction['AttractionID'] . '">
                            <input type="hidden" name="DestinationID" value="' . $attraction['DestinationID'] . '">
                            <button type="submit" name="updateAttraction" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>';
        }

        // Close the card row container
        echo '</div>';
        ?>
    </div>
</body>

</html>
