<?php
include('session.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* Custom styles for the sidebar */
    .sidebar {
        background: linear-gradient(135deg, #2C3E50, #34495e);
        color: #fff;
        height: 100vh;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        padding-top: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
    }

    .sidebar .user-info {
        text-align: center;
        margin-bottom: 30px;
    }

    .sidebar .user-info img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .sidebar .user-info h3 {
        font-size: 1.2rem;
        margin: 0;
    }

    .sidebar nav a {
        color: #ecf0f1;
        text-decoration: none;
        padding: 12px 20px;
        display: block;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-bottom: 5px;
    }

    .sidebar nav a:hover {
        background-color: #16a085;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
            padding-top: 10px;
        }

        .sidebar .user-info img {
            width: 50px;
            height: 50px;
        }

        .sidebar nav a {
            padding: 10px 15px;
        }
    }
</style>

<body>
    <!-- sidebar.html -->
    <div class="sidebar p-3">
        <!-- User Profile -->
        <div class="user-info">
            <img src="https://via.placeholder.com/80" alt="User Photo">
            <h3><?= $user_n; ?></h3>
        </div>

        <!-- Navigation -->
        <nav>
            <a href="../index.php" class="text-white">Home</a>
            <a href="index.php" class="text-white">Your dashboard</a>
            <a href="your_campaigns.php" class="text-white">Your Campaigns</a>
            <a href="notifications.php" class="text-white">Notifications</a>
        </nav>

        <!-- Logout Button -->
        <div class="logout">
            <button class="btn btn-danger w-100" onclick="confirmLogout()">Logout</button>
        </div>
    </div>

</body>

</html>