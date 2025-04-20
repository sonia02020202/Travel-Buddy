<?php
// Include database connection and helper files
include('../includes/connect.php'); // Establish DB connection
include('../includes/config.php');  // Load configuration settings
include('../includes/functions.php'); // Load reusable functions

// Check if the form was submitted using POST and 'first' name is set
if (isset($_POST['first'])) {

  // Validate that all required fields are provided
  if ($_POST['first'] and $_POST['last'] and $_POST['email'] and $_POST['password']) {

    // Build the SQL query to insert a new user into the 'users' table
    $query = 'INSERT INTO users (
        first,
        last,
        email,
        password
      ) VALUES (
        "' . mysqli_real_escape_string($connect, $_POST['first']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['last']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['email']) . '",
        "' . md5($_POST['password']) . '"  // Encrypt password using MD5 (not secure for production)
      )';

    try {
      // Execute the query
      mysqli_query($connect, $query);

      // Set success message
      set_message('User has been added');
    } catch (Exception $e) {
      // Handle errors during query execution
      echo 'Error: ' . $e->getMessage();
      die(); // Terminate script
    }
  }

  // Redirect to login page after successful signup
  header('Location: index.php');
  die(); // Ensure no further code is executed
}
?>

<!-- HTML portion for user registration form -->
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta and Bootstrap CSS -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <title>Discover Dash - Admin Sign Up</title>
</head>

<body>
  <!-- Include navigation bar -->
  <?php include('../reusables/nav.php'); ?>

  <!-- Signup form container -->
  <div class="container">
    <h1 class="text-center mt-5">Sign Up</h1>

    <!-- Admin signup form -->
    <form method="post" class="mt-5">
      <!-- First name input -->
      <div class="form-group">
        <label for="first">First Name</label>
        <input type="text" class="form-control" name="first" placeholder="First Name" required>
      </div>

      <!-- Last name input -->
      <div class="form-group">
        <label for="last">Last Name</label>
        <input type="text" class="form-control" name="last" placeholder="Last Name" required>
      </div>

      <!-- Email input -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email" required>
      </div>

      <!-- Password input -->
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>

      <!-- Submit button -->
      <input type="submit" class="btn btn-dark mt-3" value="Sign Up">
    </form>
  </div>
</body>

</html>
