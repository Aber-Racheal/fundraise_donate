<?php
    session_start();
?>

<?php
require_once 'php/config.php';

$fetch_data = "SELECT * FROM users";

$querry = mysqli_query($conn, $fetch_data);

if($querry == TRUE){
 while ($user_data = mysqli_fetch_assoc($querry)) {
    $fetched_contact =$user_data['contact_number'];
    $fetched_email =$user_data['email'];
    $fetched_password =$user_data['password'];
    $fetched_name =$user_data['full_name'];
 }
}else{
    echo "Something went wrong!";
}
?>

<?php
require_once 'php/config.php';

if (isset($_POST['signup'])) {
    $full_name = mysqli_real_escape_string($conn,  $_POST['full_name']);
    $email = mysqli_real_escape_string($conn,  $_POST['email']);
    $password = mysqli_real_escape_string($conn,  $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn,  $_POST['confirm_password']);
    $contact = mysqli_real_escape_string($conn,  $_POST['contact']);
    $location = mysqli_real_escape_string($conn,  $_POST['location']);
    $gov_id = mysqli_real_escape_string($conn,  $_POST['govId']);
    $agreement = mysqli_real_escape_string($conn,  $_POST['agreement']); 
};

    // Ensure passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Hash the password before saving it
        $password = password_hash($password, PASSWORD_DEFAULT);

if ($email == $fetched_email) {
   echo "Email exists!";
}elseif ($email == $fetched_email && $full_name == $fetched_name && $password == $fetched_password) {
    echo "Account already exists";
}elseif ($full_name == $fetched_name && $password == $fetched_password) {
    echo "Account already exists";
}else {
    $insert_data = "INSERT INTO users(user_id, full_name, email, password, contact_number, location, government_issued_id, agreement) 
    VALUES('', '$full_name', '$email', '$password', '$contact',  ' $location', ' $gov_id', ' $agreement')";
    $querry = mysqli_query($conn, $insert_data);

    if($querry == TRUE){
        $_SESSION['full_name'] = $full_name;
        $_SESSION['password'] = $password;

        header('location: account/');
       }else{
           echo "Failed to register, please try again later";
       }
}}
?>;