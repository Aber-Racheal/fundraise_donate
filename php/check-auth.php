<?php
session_start();

// Check if user is logged in (you can check based on whatever session variable you are using)
if (isset($_SESSION['full_name']) && !empty($_SESSION['full_name'])) {
    echo "logged_in";
} else {
    echo "not_logged_in";
}
?>
