<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title displayed on browser tab -->
    <title>Travel Buddy</title>

    <!-- Bootstrap CSS for responsive and styled components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Popper.js (required for Bootstrap tooltips/popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <!-- Bootstrap JS (handles dropdowns, modals, carousel, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <!-- Custom CSS styles -->
    <style>
        /* Ensure navbar stays on top */
        .navbar {
            position: absolute;
            width: 100%;
            z-index: 1000;
        }

        /* Limit carousel height */
        #carouselExampleCaptions {
            max-height: calc(100vh - 56px); /* Full screen minus navbar */
        }

        /* Make carousel images fill space appropriately */
        .carousel-item img {
            height: 100%;
            width: auto;
            object-fit: cover;
        }

        /* Vertically center carousel captions */
        .carousel-caption {
            top: 50%;
            transform: translateY(-50%);
        }

        /* Prevent horizontal scroll */
        body {
            min-height: calc(100vh - 56px);
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <!-- Navigation bar using Bootstrap classes -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Travel Buddy</a>
            <?php include('includes/nav.php') ?> <!-- Dynamically include navigation menu via PHP -->
        </div>
    </nav>

    <!-- Bootstrap carousel section for showcasing images and messages -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        
        <!-- Navigation dots for carousel -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <!-- Carousel items/slides -->
        <div class="carousel-inner">
            <!-- Slide 1: Airplane view -->
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1488085061387-422e29b40080?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHRyYXZlbHxlbnwwfHwwfHx8MA%3D%3D"
                    class="d-block w-100" alt="Airplane window view">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-size:80px">Looking for a travel destination?</h5>
                    <p style="font-size:30px">Find the top places to go to this vacation</p>
                </div>
            </div>

            <!-- Slide 2: Family vacation -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1539635278303-d4002c07eae3?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fHRyYXZlbHxlbnwwfHwwfHx8MA%3D%3D"
                    class="d-block w-100" alt="family on vacation">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-size:80px">Plan ahead your trips</h5>
                    <p style="font-size:30px">Get all the details about the top attractions before you visit</p>
                </div>
            </div>

            <!-- Slide 3: Lake with boat -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fHRyYXZlbHxlbnwwfHwwfHx8MA%3D%3D"
                    class="d-block w-100" alt="boat in lake">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-size:80px">Relax and enjoy</h5>
                    <p style="font-size:30px">So what are you waiting for?</p>
                </div>
            </div>
        </div>

        <!-- Left carousel control -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <!-- Right carousel control -->
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</body>

</html>
