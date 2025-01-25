<?php
session_start();
?>
<?php include('session.php') ?>
<?php include('sidebar.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="css/logout-btn.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 250px; /* Sidebar offset */
            padding: 30px;
        }

        /* Heading Style */
        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        /* Notification Card Styles */
        .notification-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .notification-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .notification-card h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .notification-card p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        /* Button Style */
        .notification-card .btn {
            background-color: #2980b9;
            color: white;
            padding: 8px 18px;
            font-size: 0.9rem;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .notification-card .btn:hover {
            background-color: #3498db;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .notification-card {
                padding: 15px;
            }

            .notification-card .btn {
                padding: 6px 16px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar (imported from sidebar.php) -->
        <?php include('sidebar.php'); ?>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <h2>Notifications</h2>

            <!-- Sample Notifications -->
            <div class="d-flex flex-column">
                <!-- Notification 1 -->
                <div class="notification-card">
                    <h4>New Donation Received</h4>
                    <p>You've received a new donation of $50 for your campaign!</p>
                    <a href="#" class="btn">View Details</a>
                </div>

                <!-- Notification 2 -->
                <div class="notification-card">
                    <h4>Campaign Ended</h4>
                    <p>Your campaign "Help for Health" has successfully ended. Thank you for your efforts!</p>
                    <a href="#" class="btn">View Campaign</a>
                </div>

                <!-- Notification 3 -->
                <div class="notification-card">
                    <h4>Campaign Milestone Achieved</h4>
                    <p>Congratulations! Your campaign has reached its $1000 goal.</p>
                    <a href="#" class="btn">See Milestone</a>
                </div>

                <!-- Notification 4: Campaign Created Successfully -->
                <div class="notification-card">
                    <h4>Campaign Created Successfully</h4>
                    <p>Your campaign has been created successfully. All the best in your fundraising journey!</p>
                    <a href="#" class="btn">View Campaign</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal (Hidden by default) -->
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
