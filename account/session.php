<?php
require_once '../php/config.php';
if (isset($_SESSION['full_name'])) {
    $user = $_SESSION['full_name'];
    $user_password = $_SESSION['password'];
    $fetch_data = "SELECT * FROM users WHERE full_name='$user' AND password = '$user_password' ";
    $querry = mysqli_query($conn, $fetch_data);
    if ($querry == TRUE) {
        $data = mysqli_fetch_assoc($querry);
        $user_id = $data['user_id'];
        $user_n = $data['full_name'];
        
    }else {
        echo "Database failed!";
    }
}else{
    header('location: ../login.html');
}
?>