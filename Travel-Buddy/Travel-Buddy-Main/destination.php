<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character encoding and viewport for responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title shown in the browser tab -->
    <title>Travel Buddy - Destinations</title>

    <!-- Import Bootstrap CSS for responsive design and UI components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Custom inline CSS styles -->
    <style>
        /* Style for country label under city name */
        .country {
            color: gray;
            font-size: 12px;
            margin-top: -5px;
        }

        /* Card styling for each destination */
        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), 
                        .3s box-shadow, 
                        .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
            cursor: pointer;
        }

        /* Hover effect for card to give lift and shadow */
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 
                        0 4px 8px rgba(0, 0, 0, .06);
        }

        /* Flex layout for buttons */
        .buttons {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    <!-- Include reusable navigation bar from external PHP file -->
    <?php include ('reusables/nav.php') ?>

    <!-- Main content container -->
    <div class="container">
        <!-- Page heading -->
        <div class="row">
            <div class="col">
                <h1 class="display-5 mt-4 mb-4">Destinations</h1>
            </div>
        </div>

        <?php
        // Connect to MySQL database using provided credentials
        $connect = mysqli_connect(
            'sql213.infinityfree.com',  // Host
            'if0_38491058',             // Username
            'Infinity1101',             // Password
            'if0_38491058_db_travelwise'// Database name
        );

        // SQL query to fetch all destination records
        $query = 'SELECT * FROM destination';

        // Run the query and store the result
        $destinations = mysqli_query($connect, $query);

        // Handle connection errors
        if (mysqli_connect_error()) {
            die ("Connection error: " . mysqli_connect_error());
        }

        // Start Bootstrap grid for displaying destination cards
        echo '<div class="row row-cols-1 row-cols-md-2 g-4">';

        // Loop through each destination and display it in a card format
        foreach ($destinations as $destination) {
            echo '
            <div class="col">
                <div class="card">
                    <!-- Destination image with responsive sizing and cropping -->
                    <img src="' . $destination['ImageURL'] . '" 
                         class="card-img-top img-sizing img-fluid" 
                         alt="destination image" 
                         style="width: 100%; height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <!-- City name -->
                        <h4 class="card-title">' . $destination['City'] . '</h4>
                        <!-- Country name below city -->
                        <h6 class="card-title country">' . $destination['Country'] . '</h6>
                        <!-- Short description -->
                        <p class="card-text">' . $destination['Description'] . '</p>

                        <!-- Button to view more details (sends user to destinationDetails.php) -->
                        <div class="buttons">
                            <div class="viewmore">
                                <form method="GET" action="destinationDetails.php">
                                    <!-- Pass destination ID as hidden form input -->
                                    <input type="hidden" name="DestinationID" value="' . $destination['DestinationID'] . '">
                                    <!-- Submit button -->
                                    <button type="submit" name="details" class="btn btn-dark">View More</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        // Close the grid container
        echo '</div>';
        ?>
    </div> <!-- End of main container -->
</body>

</html>
