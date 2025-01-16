<?php
session_start(); // Assuming you're using PHP sessions for authentication

// Check if the user is authenticated
if (isset($_SESSION['user_id'])) {
    // User is authenticated
    http_response_code(200);  // OK response
} else {
    // User is not authenticated
    http_response_code(401);  // Unauthorized response
}
?>
