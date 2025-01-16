<?php
require_once 'php/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "This email is already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind for inserting new user
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $full_name, $email, $hashed_password);

            // Execute
            if ($stmt->execute()) {
                echo "Registration successful.";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}

$conn->close();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the signup (same as before)

    // After successful signup
    $_SESSION['user_id'] = $user_id;  // Save user ID in session to mark them as authenticated
    header('Location: verify.html');  // Redirect to fundraise page
    exit();
}
?>
