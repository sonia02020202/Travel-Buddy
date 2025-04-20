<?php
    // Define the base URL for the project
    // $base_url = "http://localhost/humber/Travel-Buddy/Travel-Buddy-Main/"; // Local version (commented out)
    $base_url = "http://http-5225-0na.42web.io/Travel-Buddy-Main/"; // Live/hosted version
?>

<!-- Navigation bar using Bootstrap classes for responsive layout -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        
        <!-- Brand logo and home link -->
        <a class="navbar-brand" href="<?=$base_url; ?>">Travel Buddy</a>
        
        <!-- Toggler button for collapsing the navbar on smaller screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Collapsible section containing the navigation links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <!-- Navigation link to Locations (destination.php) -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?=$base_url; ?>destination.php">Locations</a>
                </li>
                
                <!-- Navigation link to Attractions (attractions.php) -->
                <li class="nav-item">
                    <a class="nav-link" href="<?=$base_url; ?>attractions.php">Attractions</a>
                </li>
                
                <!-- Direct link to Admin Dashboard (admin/index.php) -->
                <a class="nav-link" href="<?=$base_url; ?>admin/index.php">Admin Dashboard</a>
            </ul>
        </div>
    </div>
</nav>
