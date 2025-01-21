<?php
// Include the database connection file
include('php/config.php');

// Get the campaign details from the URL parameters
$campaign_id = $_GET['campaign_id'];
$title = $_GET['title'];
$description = $_GET['description'];
$image = $_GET['picture'];
$expected_amount = $_GET['expected_amount'];

// Close the database connection (we'll fetch the data via AJAX)
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Help a Hand</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet" />

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="css/animate.css" />

    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />

    <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="css/jquery.timepicker.css" />

    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin-top: 40px;
        }

        .image-container img {
            width: 60%;
            max-width: 300px;
            /* Limit the image width to 600px */
            height: auto;
            /* Maintain the aspect ratio */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            /* Center the image */
            display: block;
            /* Ensure the image is block-level to center it */
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .card-text {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .progress {
            height: 20px;
            border-radius: 5px;
        }

        .progress-bar {
            height: 100%;
            line-height: 20px;
            color: white;
            text-align: center;
            border-radius: 5px;
            transition: width 1s ease-in-out;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-control,
        .form-select {
            font-size: 1.1rem;
            padding: 12px;
            border-radius: 5px;
        }

        .btn-primary {
            font-size: 1.2rem;
            padding: 12px;
            border-radius: 5px;
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .d-grid {
            margin-top: 20px;
        }

        /* For the Payment Method Section */
        #paymentDetails {
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 10px;
            margin-top: 15px;
        }

        /* Additional margin for spacing */
        .mb-3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<html>
<body>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <p class="mb-0 phone pl-md-2">
                        <a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span>+256 393249845</a>
                        <a href="#"><span class="fa fa-paper-plane mr-1"></span>helpahand@email.com</a>
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end">
                    <div class="social-media">
                        <p class="mb-0 d-flex">
                            <a
                                href="#"
                                class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a
                                href="#"
                                class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a
                                href="#"
                                class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            <a
                                href="#"
                                class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav
        class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
        id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Help a Hand</a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#ftco-nav"
                aria-controls="ftco-nav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="fundraise.html" class="nav-link">Fundraise</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php#donate-homepage" class="nav-link">Donate</a>
                    </li>
                    <li class="nav-item">
                        <a href="causes.php" class="nav-link">Causes</a>
                    </li>
                    <li class="nav-item active cta">
                        <a href="about.html" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.html" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <section
        class="hero-wrap hero-wrap-2"
        style="background-image: url('images/bg_2.jpg')"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2">
                        <span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>Donate <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                    <h1 class="mb-0 bread">Donate</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <h2>Support Our Cause</h2>
        <div class="image-container">
            <img src="uploads/<?php echo $image; ?>" alt="Campaign Image">
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Campaign Information Card -->
                <div class="card">
                    <div class="card-body">
                        <h4 id="campaignTitle" class="card-title"><?php echo htmlspecialchars($title); ?></h4>
                        <p id="campaignDescription" class="card-text"><?php echo htmlspecialchars($description); ?></p>
                        <p><strong>Target Amount:</strong> $<span id="campaignTarget"><?php echo number_format($expected_amount, 2); ?></span></p>
                        <p><strong>Amount Raised:</strong> $<span id="amountRaised">0.00</span></p>

                        <!-- Progress Bar -->
                        <div class="progress">
                            <div id="progressBar" class="progress-bar progress-bar-striped" style="width: 0%; background-color: #28a745;">
                                0%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donation Form -->
                <form id="donationForm">
                    <div class="mb-3">
                        <label for="donationAmount" class="form-label">DONATION AMOUNT ($)</label>
                        <input type="number" class="form-control" id="donationAmount" placeholder="Enter the amount you wish to donate" required>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="paymentMethod" class="form-label">SELECT PAYMENT METHOD</label>
                        <select class="form-select" id="paymentMethod" required>
                            <option value="">Choose...</option> -->
                    <!-- <option value="stripe">Credit/Debit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="bank">Bank Transfer</option> -->


                    <!-- <option value="card">Pesapal</option>
                        </select>
                    </div> -->

                    <!-- <div id="paymentDetails" class="mt-3"></div> -->

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">DONATE NOW</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <h2 class="footer-heading">Help a Hand.</h2>
                    <p>
                        We provide a platform where anyone can create, manage, and promote
                        their fundraising campaigns at no cost.
                    </p>
                    <ul class="ftco-footer-social p-0">
                        <li class="ftco-animate">
                            <a
                                href="#"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Twitter"><span class="fa fa-twitter"></span></a>
                        </li>
                        <li class="ftco-animate">
                            <a
                                href="#"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Facebook"><span class="fa fa-facebook"></span></a>
                        </li>
                        <li class="ftco-animate">
                            <a
                                href="#"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Instagram"><span class="fa fa-instagram"></span></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 pl-lg-5 mb-4 mb-md-0">
                    <h2 class="footer-heading">Quick Links</h2>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="py-2 d-block">Home</a></li>
                        <li>
                            <a href="fundraise.html #start-fundraise-section" class="py-2 d-block">Fundraise</a>
                        </li>
                        <li>
                            <a href="index.php#donate-homepage" class="py-2 d-block">Donate</a>
                        </li>
                        <li><a href="causes.php" class="py-2 d-block">Causes</a></li>
                        <li><a href="about.html" class="py-2 d-block">About</a></li>
                        <li><a href="contact.html" class="py-2 d-block">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <h2 class="footer-heading">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li>
                                <span class="icon fa fa-map"></span><span class="text">
                                    Kakebe Technologies Head Office, Plot 43 Lira - Soroti Rd,
                                    Lira</span>
                            </li>
                            <li>
                                <a href="#"><span class="icon fa fa-phone"></span><span class="text">+256 393249845</span></a>
                            </li>
                            <li>
                                <a href="#"><span class="icon fa fa-paper-plane"></span><span class="text"> info@kakebetech.com</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <p>
                        <a href="index.php #donate-homepage" class="btn btn-quarternary" id="donate-now">Donate Now</a>
                    </p>
                    <p>
                        <a
                            href="fundraise.html #start-fundraise-section"
                            class="btn btn-quarternary"
                            id="start-fundraise">start fundraise</a>
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p class="copyright">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved | Help a Hand
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>

    	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to fetch the donation progress from the server
        function fetchProgress() {
            const campaignId = <?php echo $campaign_id; ?>; // Pass the campaign ID from PHP
            fetch(`get_donations.php?campaign_id=${campaignId}`)
                .then(response => response.json())
                .then(data => {
                    // Update the progress bar and amount raised
                    document.getElementById('amountRaised').innerText = data.total_donated;
                    document.getElementById('progressBar').style.width = `${data.progress_percentage}%`;
                    document.getElementById('progressBar').innerText = `${data.progress_percentage}%`;
                })
                .catch(error => console.error('Error fetching donation progress:', error));
        }

        // Fetch progress every 5 seconds (you can adjust this interval)
        setInterval(fetchProgress, 3000);

        // Fetch initial progress when the page loads
        fetchProgress();

        // Dynamic Payment Method Fields (Same as before)
        document.getElementById("paymentMethod").addEventListener("change", function() {
            const paymentDetails = document.getElementById("paymentDetails");
            paymentDetails.innerHTML = ""; // Clear previous fields

            const selectedMethod = this.value;
            if (selectedMethod === "stripe") {
                paymentDetails.innerHTML = `...`; // Add the fields for Stripe
            } else if (selectedMethod === "paypal") {
                paymentDetails.innerHTML = `...`; // Add the fields for PayPal
            } else if (selectedMethod === "bank") {
                paymentDetails.innerHTML = `...`; // Add the fields for Bank Transfer
            }
        });

        // Simulate donation success
        document.getElementById("donationForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const donationAmount = document.getElementById("donationAmount").value;
            // Show success modal or handle donation logic here
        });
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
</body>

</html>