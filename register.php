<?php
require_once 'php/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];
    $gov_id = $_POST['govId'];
    $agreement = $_POST['agreement'];

    $agreement = isset($_POST['agreement']) ? 'agreed' : 'disagreed'; 


    // Basic form validation
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } elseif (strlen($password) < 8) { // Check for password strength
        echo "Password must be at least 8 characters long.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "This email is already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind for inserting new user
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, contact_number, location, government_issued_id, agreement) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $full_name, $email, $hashed_password, $contact, $location, $gov_id, $agreement);

            // Execute
            if ($stmt->execute()) {
                // Start the session after successful registration
                $_SESSION['user_id'] = $stmt->insert_id;  // Save the user ID in the session
                
                header('Location: login.html');  // Redirect to the verification page
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>
