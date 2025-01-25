<?php
session_start();
require_once 'php/config.php';

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
}


if(empty($email) || empty($password)){
    echo "Both fields are required for you to login!";
}else{
    $query_db = "SELECT user_id, password FROM users WHERE email = ?";
    $prep_template = $conn->prepare($query_db);
    $prep_template -> bind_param("s", $email);
    $prep_template -> execute();
    $results = $prep_template ->get_result();


   if($results -> num_rows >0){
    $user = $results->fetch_assoc();

    if(password_verify($password, $user['password'])){
        $_SESSION['email'] = $email;

        header('Location: index.php');

        exit;
    }else{
        echo "Invalid password. please try again.";
    }
   }else{
    echo "No account found with that email address";
   }
}



?>