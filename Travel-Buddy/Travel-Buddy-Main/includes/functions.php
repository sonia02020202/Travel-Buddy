<?php
// This function checks if the user is logged in as Admin
function secure()
{
  // If the 'id' session variable is not set, the user is not logged in
  if (!isset($_SESSION['id'])) {
    // Display an alert and redirect the user to the homepage
    echo '<script>
        alert("You are not logged in as Admin, please log in first.");
        window.location.href = "/";
      </script>';
    // Stop further script execution
    die();
  }
}

// This function sets a custom session message to display later
function set_message($message)
{
  // Store the message in the session
  $_SESSION['message'] = $message;
}

// This function retrieves and displays the stored session message
function get_message()
{
  // Check if a message is stored in the session
  if (isset($_SESSION['message'])) {
    // Display the message in a styled paragraph with an icon
    echo '<p style="padding: 0 1%;" class="error">
        <i class="fas fa-exclamation-circle"></i> 
        ' . $_SESSION['message'] . '
      </p>
      <hr>';
    // Clear the message so it doesn't show again
    unset($_SESSION['message']);
  }
}
