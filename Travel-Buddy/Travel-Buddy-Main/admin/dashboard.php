<?php
// Include database connection, configuration, and utility functions
include ('../includes/connect.php');
include ('../includes/config.php');
include ('../includes/functions.php');

// Secure the page - likely checks if user is logged in
secure();

// Build SQL query to fetch user details using session-stored user ID
$query = 'SELECT * FROM users WHERE id = ' . $_SESSION['id'];

// Try executing the query and fetching the result
try {
  // Execute the query
  $result = mysqli_query($connect, $query);
  // Fetch user details as an associative array
  $user = mysqli_fetch_assoc($result);
} catch (Exception $e) {
  // Handle exceptions and display error message
  echo 'Caught exception: ', $e->getMessage(), "\n";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Set character encoding and responsive viewport -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Load Bootstrap CSS for styling -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- Set page title -->
  <title>Discover Dash - Admin Dashboard</title>
</head>

<body>
  <!-- Include navigation bar -->
  <?php include ('../includes/nav.php'); ?>

  <!-- Main container for content -->
  <div class="container">
    <h1 class="text-center mt-5">User Profile</h1>

    <!-- Display user details -->
    <div class="mt-5">
      <p><strong>First Name:</strong>
        <?php echo $user['first']; ?>
      </p>
      <p><strong>Last Name:</strong>
        <?php echo $user['last']; ?>
      </p>
      <p><strong>Email:</strong>
        <?php echo $user['email']; ?>
      </p>

      <!-- Action buttons -->
      <a href="./destination.php" class="btn btn-dark">Manage Destination</a>
      <a href="./attractions.php" class="btn btn-dark">Manage Attractions</a>
      <a href="logout.php" class="btn btn-danger">Log Out</a>
    </div>
  </div>
</body>

</html>
