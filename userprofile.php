<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help a Hand - Fundraising Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>

        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
        }

        .navbar, .dropdown-menu {
            background-color: var(--primary);
        }

        .navbar-brand {
            color: var(--white) !important;
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .dashboard-card {
            margin-top: 20px;
        }

        .btn-custom {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-custom:hover {
            background-color: var(--secondary);
            color: var(--white);
        }

        .progress-bar-custom {
            background-color: var(--green);
        }

        .link-share {
            font-size: 1.2rem;
            color: var(--blue);
            cursor: pointer;
        }

        .alert-custom {
            background-color: var(--light);
            color: var(--dark);
        }

        .card-header {
            background-color: var(--primary);
            color: var(--white);
        }

        /* Notifications styling */
        .dropdown-item.unread {
            font-weight: bold;
        }

        .notification-icon {
            font-size: 1.5rem;
        }

        .notification-count {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.6rem;
            font-size: 0.75rem;
        }
    </style>
</head>

<body>
    <!-- Navbar with Profile, Notifications, and Logout -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Help a Hand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Notifications Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell notification-icon"></i>
                            <span class="notification-count" id="notificationCount">2</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="notificationsDropdown">
                            <li><a class="dropdown-item unread" href="#">New campaign: "Save the Oceans!"</a></li>
                            <li><a class="dropdown-item unread" href="#">You received a donation of $50!</a></li>
                            <li><a class="dropdown-item" href="#">Campaign "Feed the Hungry" has been successfully funded!</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">View All Notifications</a></li>
                        </ul>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="https://via.placeholder.com/50" alt="Profile" class="profile-avatar">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Campaigns</a></li>
                            <li><a class="dropdown-item" href="#">My Donations</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="#" class="list-group-item list-group-item-action">My Campaigns</a>
                    <a href="#" class="list-group-item list-group-item-action">Donate</a>
                    <a href="#" class="list-group-item list-group-item-action">Notifications</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <!-- Dashboard Overview -->
                <div class="card dashboard-card">
                    <div class="card-header">
                        Dashboard Overview
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Welcome, [User Name]</h5>
                        <p class="card-text">Here’s an overview of your campaigns, donations, and activities.</p>
                        <div class="row">
                            <!-- Active Campaigns -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Active Campaigns</h5>
                                        <p class="card-text">Total Active Campaigns: 3</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Donations -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Donations</h5>
                                        <p class="card-text">Total Donations Made: $500</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Campaign Goal Progress -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Campaign Progress</h5>
                                        <p class="card-text">Goal: $1000 | Raised: $500</p>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-custom" style="width: 50%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campaign List -->
                <div class="card dashboard-card">
                    <div class="card-header">
                        Your Campaigns
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Campaign Name 1</strong> - Raised: $300 of $1000 goal
                                <button class="btn btn-custom btn-sm float-end">Edit</button>
                                <button class="btn btn-outline-primary btn-sm float-end me-2">Share Link</button>
                            </li>
                            <li class="list-group-item">
                                <strong>Campaign Name 2</strong> - Raised: $200 of $500 goal
                                <button class="btn btn-custom btn-sm float-end">Edit</button>
                                <button class="btn btn-outline-primary btn-sm float-end me-2">Share Link</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Donation History -->
                <div class="card dashboard-card">
                    <div class="card-header">
                        Donation History
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Donation to Campaign 1</strong> - $100
                            </li>
                            <li class="list-group-item">
                                <strong>Donation to Campaign 2</strong> - $50
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
