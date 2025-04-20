<?php
// =======================================
// Admin Login Page
// =======================================

// Include essential files for database connection, configuration, and utility functions
include ('../includes/connect.php');
include ('../includes/config.php');
include ('../includes/functions.php');

// If the admin is already logged in (session ID exists), redirect to the dashboard
if (isset ($_SESSION['id'])) {
  header('Location: dashboard.php');
  die();
}

// If login form is submitted (email POSTed)
if (isset ($_POST['email'])) {

  // Query to find a matching user in the database using the submitted email and MD5-hashed password
  $query = 'SELECT *
    FROM users
    WHERE email = "' . $_POST['email'] . '"
    AND password = "' . md5($_POST['password']) . '"
    LIMIT 1';

  $result = mysqli_query($connect, $query);

  // If user exists, set session variables and redirect to dashboard
  if (mysqli_num_rows($result)) {
    $record = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $record['id'];
    $_SESSION['email'] = $record['email'];

    header('Location: dashboard.php');
    die();

  } else {
    // If no user found, set error message and redirect back to login page
    set_message('Incorrect email and/or password');
    header('Location: index.php');
    die();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic metadata and Bootstrap CSS for responsive styling -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <title>Travel Buddy - Admin Log In</title>
</head>

<body>
  <!-- Include site-wide navigation bar -->
  <?php include ('../includes/nav.php'); ?>

  <div class="container">
    <!-- Display any flash message set earlier (like incorrect login) -->
    <?php echo get_message(); ?>

    <h1 class="text-center my-4">Admin Log in</h1>

    <!-- Login form -->
    <form method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" placeholder="Email" required class="form-control">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" placeholder="Password" required class="form-control">
      </div>

      <!-- Submit button -->
      <input type="submit" value="Log In" class="btn btn-dark">

      <!-- Link to registration page if user doesn't have an account -->
      <a href="signUp.php" class="btn btn-link">No account? Sign Up Here</a>
    </form>
  </div>
</body>

</html>
