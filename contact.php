<?php
require_once 'php/config.php';

($_SERVER["REQUEST_METHOD"] == "POST");

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$subject = htmlspecialchars(trim($_POST['subject']));
$message = htmlspecialchars(trim($_POST['message']));

if(empty($name)||empty($email)||empty($subject)||empty($message)){
    echo "All fields are required.";
    exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Invalid email format.";
    exit;
}

$sql = "INSERT INTO contact_form(name, email, subject, message) VALUES (?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)){
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()){
        echo "Your message has been sent successfully!";
    }
    else{
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

}else{
    echo "Error: " . $conn->error;
}



$conn->close();


?>