<?php
require_once 'php/config.php';  // Make sure to include the database connection file

// Start the session at the beginning of the script
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        echo "Both fields are required.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;  // Set session variable for user_id
                echo "Login successful.";

                // Redirect to the page after successful login (fundraise or the page provided in the redirect query)
                $redirect_url = isset($_GET['redirect']) ? $_GET['redirect'] : '/';  // Default to homepage if no redirect param
                header('Location: verify.html');

                exit();  // Make sure no further code is executed
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
