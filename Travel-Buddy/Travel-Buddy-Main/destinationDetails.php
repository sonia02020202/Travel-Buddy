<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Define character encoding and responsive behavior -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title for the browser tab -->
    <title>Travel Buddy - Destinations</title>

    <!-- Link to Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Internal CSS styles for customizing layout -->
    <style>
        /* Style for country text below attraction name */
        .country {
            color: gray;
            font-size: 12px;
            margin-top: -5px;
        }

        /* Container styling */
        .container {
            margin: 20px;
            padding-top: 50px;
            display: flex;
            justify-content: center;
        }

        /* Banner heading style */
        .banner {
            background-color: black;
            color: white;
            padding-left: 50px;
            padding: 10px;
            margin: 0px;
        }

        /* Section header styling */
        .header {
            padding-left: 50px;
            background-color: #CECECE;
            color: white;
            border-radius: 5px;
        }

        /* General location section padding */
        .location {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: left;
        }

        /* Center alignment for buttons */
        .button-align {
            display: flex;
            justify-content: center;
        }

        /* Margin for Add More button */
        .add-more {
            margin: 50px;
        }

        /* Card styling for attraction display */
        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform, .3s box-shadow;
            cursor: pointer;
        }

        /* Text style for destination description */
        .description {
            font-size: 30px;
        }

        /* Image formatting in the card */
        .img-sizing {
            height: 200px;
            object-fit: cover;
        }

        /* Flex layout for destination details */
        .details {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 50px;
        }

        /* Hover effect on cards */
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }
    </style>
</head>

<body>
    <?php
    // Include navigation bar from reusable component
    include ('reusables/nav.php');

    // Check if either 'details' or 'DestinationID' is set in URL
    if ((isset($_GET['details'])) || (isset($_GET['DestinationID']))) {
        $destinationID = $_GET['DestinationID'];

        // Connect to the database
        $connect = mysqli_connect('localhost', 'root', 'root', 'if0_38491058_db_travelwise');

        // Fetch main destination details based on ID
        $destinationQuery = "SELECT City, Country, Climate, BestTimeToVisit, Description
                             FROM destination 
                             WHERE DestinationID = $destinationID";
        $destinationResult = mysqli_query($connect, $destinationQuery);

        // If destination found, display info
        if ($destinationResult) {
            $destinationRow = mysqli_fetch_assoc($destinationResult);
            $city = $destinationRow['City'];
            $country = $destinationRow['Country'];
            $Description = $destinationRow['Description'];
            $Climate = $destinationRow['Climate'];
            $BestTimeToVisit = $destinationRow['BestTimeToVisit'];

            // Output destination info
            echo '<div class="row">
                    <div class="col">
                        <h1 class="display-5 mt-4 mb-4 banner">Destination: ' . $city . ', ' . $country . '</h1>
                        <div class="container location">
                            <div>
                                <p class="description">' . $Description . '</p>
                            </div>
                            <div class="details">
                                <h5>Current climate:</h5> 
                                <p>' . $Climate . '</p>
                            </div>
                            <div class="details">
                                <h5>Best Time To Visit:</h5> 
                                <p>' . $BestTimeToVisit . '</p>
                            </div>
                        </div>
                    </div>
                  </div>';
        }

        // Query to get all attractions linked to the destination
        $query = "SELECT attractions.*
                  FROM attractions
                  INNER JOIN destination 
                  ON attractions.DestinationID = destination.DestinationID
                  WHERE attractions.DestinationID = $destinationID";
        $results = mysqli_query($connect, $query);

        // If attractions found, display each as a card
        if ($results) {
            if (mysqli_num_rows($results) > 0) {
                echo '<div class="header">
                        <h2 class="display-6">Top attractions at this location</h2>
                      </div>';
                echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
                foreach ($results as $result) {
                    echo '
                    <div class="container">
                        <div class="col">
                            <div class="card h-100">
                                <img src="' . $result['ImageURL'] . '" class="card-img-top img-sizing img-fluid" alt="destination image">
                                <div class="card-body">
                                    <h4 class="card-title">' . $result['Name'] . '</h4>
                                    <p class="card-title country">' . $result['Location'] . '</p>
                                    <p class="card-text">' . $result['Description'] . '</p>
                                    <p class="card-text"><strong>Opening Hours:</strong> ' . $result['OpeningHours'] . '</p>
                                    <p class="card-text"><strong>Admission Fee:</strong> $' . $result['AdmissionFee'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                echo '</div>';
            } else {
                // If no attractions found
                echo "No attractions found.";
            }

            // (Optional) Form to add more attractions (currently commented out)
            /*
            echo '<div class=button-align>
                    <form method="GET" action="newattraction.php">
                        <input type="hidden" name="DestinationID" value="' .$destinationID. '">
                        <button type="submit" name="addAttractions" class="btn btn-dark add-more">Add More</button>
                    </form>
                  </div>';
            */
        } else {
            // Display error if attraction query fails
            echo "Failed" . mysqli_error($connect);
        }
    } else {
        // If URL accessed without required parameters
        echo "You should not be here!";
    }
    ?>
</body>

</html>
