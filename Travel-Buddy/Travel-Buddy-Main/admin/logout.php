<?php

// Include the configuration file (e.g., database connection, session settings)
include('../includes/config.php');

// Destroy the current session, logging the user out
session_destroy();

// Redirect the user to the homepage (or login page)
header('Location: ../index.php');
