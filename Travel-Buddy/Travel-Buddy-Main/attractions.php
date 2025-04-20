<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic meta tags for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title shown in browser tab -->
    <title>Travel Buddy - Attractions</title>

    <!-- Include Bootstrap 5 for responsive layout and styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Inline custom CSS for attraction cards -->
    <style>
        /* Style for the country/location label */
        .country {
            color: gray;
            font-size: 12px;
            margin-top: -5px;
        }

        /* Style for the card layout (box-shadow, rounded corners, hover effect) */
        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), 
                        .3s box-shadow, 
                        .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
            cursor: pointer;
        }

        /* Ensure all images in cards are of uniform size and not stretched */
        .img-sizing {
            height: 200px;
            object-fit: cover;
        }

        /* Slight scale and shadow effect when hovering over a card */
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 
                        0 4px 8px rgba(0, 0, 0, .06);
        }
    </style>
</head>

<body>
    <!-- Navigation bar included from reusable PHP component -->
    <?php include ('reusables/nav.php') ?>

    <!-- Container for the page content -->
    <div class="container">

        <!-- Section Header -->
        <div class="row">
            <div class="col">
                <h1 class="display-5 mt-4 mb-4">Attractions</h1>
            </div>
        </div>

        <!-- PHP Script to retrieve and display attraction data -->
        <?php
        // Connect to the MySQL database
        $connect = mysqli_connect(
            'sql213.infinityfree.com',     // Host
            'if0_38491058',                // Username
            'Infinity1101',                // Password
            'if0_38491058_db_travelwise'   // Database Name
        );

        // Handle connection error
        if (mysqli_connect_error()) {
            die ("Connection error: " . mysqli_connect_error());
        }

        // Query to retrieve all attraction records
        $query = 'SELECT * FROM attractions';
        $attractions = mysqli_query($connect, $query);

        // Display each attraction in a responsive grid layout using Bootstrap cards
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';  // Grid layout for cards
        foreach ($attractions as $attraction) {
            echo '
            <div class="col">
                <div class="card h-100">
                    <!-- Attraction image -->
                    <img src="' . $attraction['ImageURL'] . '" 
                         class="card-img-top img-sizing img-fluid" 
                         alt="destination image">
                    
                    <!-- Card body with details -->
                    <div class="card-body">
                        <h4 class="card-title">' . $attraction['Name'] . '</h4>
                        <p class="card-title country">' . $attraction['Location'] . '</p>
                        <p class="card-text">' . $attraction['Description'] . '</p>
                        <p class="card-text"><strong>Opening Hours:</strong> ' . $attraction['OpeningHours'] . '</p>
                        <p class="card-text"><strong>Admission Fee:</strong> $' . $attraction['AdmissionFee'] . '</p>
                    </div>
                </div>
            </div>';
        }
        echo '</div>'; // Close grid container
        ?>
    </div>
</body>

</html>
