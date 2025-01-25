<?php
session_start();
?>

<?php include('sidebar.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Campaign Dashboard</title>
    <link rel="stylesheet" href="css/logout-btn.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        /* Cards with specific colors */
        .card-notifications {
            background-color: #f39c12;
            color: white;
        }

        .card-running-campaigns {
            background-color: #27ae60;
            color: white;
        }

        .card-donate {
            background-color: #e74c3c;
            color: white;
        }

        .card-body {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .card-body i {
            font-size: 3rem;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1.1rem;
        }

        .btn-light {
            background-color: #fff;
            color: #333;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-light:hover {
            background-color: #dcdcdc;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        /* Icon in the Card */
        .card-icon {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px; /* Space for Sidebar */
            padding: 30px;
            max-width: calc(100% - 250px); /* Ensure content doesn't overflow */
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar (imported) -->
        <?php include('sidebar.php'); ?>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <div class="row">
                <!-- Notifications Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-notifications">
                        <div class="card-body">
                            <i class="fas fa-bell card-icon"></i>
                            <div>
                                <h4 class="card-title">Notifications</h4>
                                <p class="card-text">You have 3 new notifications.</p>
                                <a href="notifications.php" class="btn btn-light">View Notifications</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Running Campaigns Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-running-campaigns">
                        <div class="card-body">
                            <i class="fas fa-cogs card-icon"></i>
                            <div>
                                <h4 class="card-title">Your Running Campaigns</h4>
                                <p class="card-text">You have 2 active campaigns.</p>
                                <a href="your_campaigns.php" class="btn btn-light">Manage Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donate Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-donate">
                        <div class="card-body">
                            <i class="fas fa-heart card-icon"></i>
                            <div>
                                <h4 class="card-title">Donate to a Cause</h4>
                                <p class="card-text">Support a cause today!</p>
                                <a href="index.php #donate-homepage" class="btn btn-light">Donate Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal (Hidden by default) -->
    <div id="logoutModal" class="modal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="logout()">Yes</button>
                    <button type="button" class="btn btn-danger" onclick="cancelLogout()">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmLogout() {
            var modal = new bootstrap.Modal(document.getElementById('logoutModal'));
            modal.show();
        }

        function cancelLogout() {
            var modal = bootstrap.Modal.getInstance(document.getElementById('logoutModal'));
            modal.hide();
        }

        function logout() {
            alert("You have logged out successfully.");
            window.location.href = "login.html"; // Example: Redirect to login page
        }
        
    </script>
</body>

</html>
