<?php
session_start();
?>

<?php
// Include the database connection file
include('php/config.php');

// Set the number of items per page for the index page
$itemsPerPage = 4;

// Query to get all campaigns
$sql = "SELECT * FROM campaigns ORDER BY created_at DESC LIMIT $itemsPerPage"; // Ensure correct table name
$result = $conn->query($sql);

// Check for database query errors
if (!$result) {
	die("Error fetching campaigns: " . $conn->error);
}

// Fetch the data
$campaigns = [];
while ($row = $result->fetch_assoc()) {
	$campaigns[] = $row;
}

// Close the database connection
$conn->close();

// Check if there are any campaigns
if (empty($campaigns)) {
	echo "No campaigns available.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Help a Hand</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">


	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">

	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/style.css">


	<style>
		#start-fundraise {
			background-color: #ffc107;
			color: black;
			border: #ffc107;
			margin-left: 20px;
		}

		#start-fundraise-footer {
			background-color: #ffc107;
			border: #ffc107;
		}


		/* Ensure the cards have the same height */
		.card {
			display: flex;
			flex-direction: column;
			height: 100%;
			box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
			overflow: hidden;
			transition: all 0.3s ease;
		}

		.card:hover {
			box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);
		}

		/* Card Image */
		.card .img {
			height: 200px;
			background-size: cover;
			background-position: center;
			margin-bottom: 15px;
			object-fit: cover;
			width: 100%;
		}

		/* Card Text */
		.card .text {
			flex-grow: 1;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			padding: 15px;
		}

		/* Description Scrollbar */
		.card-description {
			max-height: 100px;
			/* Limiting the height */
			overflow-y: auto;
			/* Only show scrollbar when content overflows */
			margin-bottom: 15px;
			padding-right: 10px;
			scrollbar-width: thin;
			/* Thin scrollbar for Firefox */
			scrollbar-color: #4CAF50 #f1f1f1;
			/* Set a beautiful green color for Firefox */
		}

		/* For Webkit-based browsers (Chrome, Safari, etc.) */
		.card-description::-webkit-scrollbar {
			width: 8px;
			/* Set width of the scrollbar */
		}

		.card-description::-webkit-scrollbar-track {
			background-color: #f1f1f1;
			/* Light color for the track */
			border-radius: 10px;
			/* Rounded corners for the track */
		}

		.card-description::-webkit-scrollbar-thumb {
			background-color: #4CAF50;
			/* Beautiful green thumb */
			border-radius: 10px;
			/* Rounded corners for the thumb */
			border: 2px solid #f1f1f1;
			/* Add border to make it feel like part of the track */
		}

		.card-description::-webkit-scrollbar-thumb:hover {
			background-color: #45a049;
			/* Darker thumb when hovered */
		}

		/* Hide scrollbar arrows */
		.card-description::-webkit-scrollbar-button {
			display: none;
			/* Hide the up/down buttons */
		}

		/* Button Styling */
		.card .btn {
			margin-top: auto;
			border: none;
			color: black;
			padding: 10px 20px;
			font-size: 16px;
			cursor: pointer;
			border-radius: 25px;
			transition: background-color 0.3s ease;
		}

		.card .btn:hover {
			background-color: #e0a800;
		}

		/* General Styling for the section */
		.ftco-section {
			background-color: #f9f9f9;
			/* Light background for the entire section */
			padding: 50px 0;
		}

		.services {
			background-color: #fff;
			/* Default white background for each box */
			border-radius: 10px;
			/* Rounded corners for each box */
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
			/* Soft shadow for depth */
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			/* Smooth hover transition */
			padding: 30px;
		}

		.services:hover {
			transform: translateY(-10px);
			/* Slight lift on hover */
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
			/* Enhanced shadow on hover */
		}

		.services .icon {
			border-radius: 50%;
			width: 80px;
			height: 80px;
			margin-bottom: 20px;
			display: flex;
			justify-content: center;
			align-items: center;
			color: #fff;
			/* Icon color */
			font-size: 40px;
			transition: background-color 0.3s ease;
		}

		/* Corrected Color Styles for Each Box */
		.bg-success {
			background-color: #28a745;
			/* Green background */
		}

		.bg-success .icon {
			background-color: #218838;
			/* Darker green for the icon */
		}

		.bg-warning {
			background-color: #ffc107;
			/* Yellow background */
		}

		.bg-warning .icon {
			background-color: #e0a800;
			/* Darker yellow for the icon */
		}

		.bg-danger {
			background-color: #dc3545;
			/* Red background */
		}

		.bg-danger .icon {
			background-color: #c82333;
			/* Darker red for the icon */
		}

		.bg-primary {
			background-color: #007bff;
			/* Blue background */
		}

		.bg-primary .icon {
			background-color: #e0a800;
			/* Darker blue for the icon */
		}

		.services h3 {
			font-size: 22px;
			font-weight: 600;
			color: #fff;
			/* White text color for headings */
			margin-bottom: 15px;
			line-height: 1.4;
		}

		.services p {
			font-size: 14px;
			color: #fff;
			/* White text color for paragraphs */
			line-height: 1.6;
		}

		/* Hover Effects on Boxes */
		.services:hover h3,
		.services:hover p {
			color: #fff;
			/* Keep the text white on hover */
		}

		/* Responsive Styles */
		@media (max-width: 768px) {
			.services {
				padding: 20px;
			}

			.services .icon {
				width: 70px;
				height: 70px;
			}

			.services h3 {
				font-size: 20px;
			}

			.services p {
				font-size: 13px;
			}
		}


		.fundraise-account{
			margin: auto;
		}
	</style>
</head>

<body>

	<div class="wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center">
					<p class="mb-0 phone pl-md-2">
						<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +256 393249845</a>
						<a href="#"><span class="fa fa-paper-plane mr-1"></span>helpahand@email.com</a>
					</p>
				</div>
				<div class="col-md-6 d-flex justify-content-md-end">
					<div class="social-media">
						<p class="mb-0 d-flex">
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php">Help a Hand</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active cta"><a href="index.php" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="fundraise.html" class="nav-link">Fundraise</a></li>
					<li class="nav-item"><a href="donate.php" class="nav-link">Donate</a></li>
					<li class="nav-item"><a href="causes.php" class="nav-link">Causes</a></li>
					<li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
					<li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>

				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->

	<section class="hero-wrap js-fullheight">
		<div class="home-slider js-fullheight owl-carousel">
			<div class="slider-item js-fullheight" style="background-image:url(images/bg_1.jpg);">
				<div class="overlay-1"></div>
				<div class="overlay-2"></div>
				<div class="overlay-3"></div>
				<div class="overlay-4"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center">
						<div class="col-md-10 col-lg-7 ftco-animate">
							<div class="text w-100">
								<h2>Help the poor in need</h2>
								<h1 class="mb-3">Lend a helping hand or get involved</h1>
								<div class="d-flex meta">
									<div class="">
										<p class="mb-0"><a href="index.php#donate-homepage" class="btn btn-secondary py-3 px-2 px-md-4" id="donate-now">Donate Now</a></p>
									</div>
									<div class="">
										<p class="mb-0"><a href="fundraise.html" class="btn btn-secondary py-3 px-2 px-md-4" id="start-fundraise">start Fundraise</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item js-fullheight" style="background-image:url(images/bg_2.jpg);">
				<div class="overlay-1"></div>
				<div class="overlay-2"></div>
				<div class="overlay-3"></div>
				<div class="overlay-4"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center">
						<div class="col-md-10 col-lg-7 ftco-animate">
							<div class="text w-100">
								<h2>Uplifting Hope</h2>
								<h1 class="mb-3">Discover Non-Profit Charity Platform</h1>
								<div class="d-flex meta">
									<div class="">
										<p class="mb-0"><a href="index.php#donate-homepage" class="btn btn-secondary py-3 px-2 px-md-4" id="donate-now">donate now</a></p>
									</div>
									<div class="">
										<p class="mb-0"><a href="fundraise.html" class="btn btn-secondary py-3 px-2 px-md-4" id="start-fundraise">start Fundraise</a></p>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item js-fullheight" style="background-image:url(images/bg_3.jpg);">
				<div class="overlay-1"></div>
				<div class="overlay-2"></div>
				<div class="overlay-3"></div>
				<div class="overlay-4"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center">
						<div class="col-md-10 col-lg-7 ftco-animate">
							<div class="text w-100">
								<h2>Elevating Hope</h2>
								<h1 class="mb-3">Giving Hope to the Hopeless People</h1>
								<div class="d-flex meta">
									<div class="">
										<p class="mb-0"><a href="index.php#donate-homepage" class="btn btn-secondary py-3 px-2 px-md-4" id="donate-now">donate now</a></p>
									</div>
									<div class="">
										<p class="mb-0"><a href="fundraise.html" class="btn btn-secondary py-3 px-2 px-md-4" id="start-fundraise">start fundraise</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img">
		<!-- <div class="overlay"></div> -->
		<div class="container">
			<div class="row">
				<div class="row-md-7 wrap-about py-5">
					<div class="heading-section pr-md-5 pt-md-5">
						<span class="subheading">Welcome to Help a Hand</span>
						<h2 class="mb-4">We are here to help everyone in need</h2>
						<p>Help a Hand empowers you to make a lasting impact by donating to meaningful causes or starting your own fundraising campaigns to support those in need. Our platform connects you with individuals and communities seeking help, enabling you to contribute your time, resources, or skills to create positive change. Whether you’re offering support through donations or championing a cause close to your heart, every action builds a network of compassion and hope. Together, we can transform lives and bring assistance to those who need it most. Every effort counts; because when we uplift one another, we all thrive.</p>
					</div>
					<p><a href="fundraise.html" class="btn btn-secondary btn-outline-secondary">START FUNDRAISE</a></p>
				</div>
			</div>
		</div>
	</section>


	<section class="ftco-section ftco-no-pt ftco-no-pb">
		<div class="container">
			<div class="row no-gutters justify-content-center"> <!-- Add justify-content-center -->

				<!-- First box (Start Donating) - Green -->
				<div class="col-md-3 d-flex align-items-stretch">
					<div class="services text-center p-4 bg-success text-light">
						<div class="icon d-flex align-items-center justify-content-center mb-3">
							<span class="fas fa-hand-holding-heart" style="font-size: 50px;"></span> <!-- Font Awesome icon -->
						</div>
						<h3>Start <br>Donating</h3>
						<p>Support a cause you believe in and help provide essential resources where they're needed most.</p>
					</div>
				</div>

				<!-- Second box (Quick Fundraising) - Yellow -->
				<div class="col-md-3 d-flex align-items-stretch">
					<div class="services text-center p-4 bg-warning text-dark">
						<div class="icon d-flex align-items-center justify-content-center mb-3">
							<span class="fas fa-piggy-bank" style="font-size: 50px;"></span> <!-- Font Awesome icon -->
						</div>
						<h3>Quick <br>Fundraising</h3>
						<p>Start your campaign in minutes and rally support. Fundraise now and make a difference fast!</p>
					</div>
				</div>

				<!-- Third box (Track Progress) - Red -->
				<div class="col-md-3 d-flex align-items-stretch">
					<div class="services text-center p-4 bg-danger text-light">
						<div class="icon d-flex align-items-center justify-content-center mb-3">
							<span class="fas fa-chart-line" style="font-size: 50px;"></span> <!-- Font Awesome icon -->
						</div>
						<h3>Track <br>Progress</h3>
						<p>Monitor your campaign progress, set goals, and see the impact you're making.</p>
					</div>
				</div>

				<!-- Fourth box (Join Community) - Blue -->
				<div class="col-md-3 d-flex align-items-stretch">
					<div class="services text-center p-4 bg-primary text-light">
						<div class="icon d-flex align-items-center justify-content-center mb-3">
							<span class="fas fa-users" style="font-size: 50px;"></span> <!-- Font Awesome icon -->
						</div>
						<h3>Join <br>Community</h3>
						<p>Join a community of donors and make an impact together. Your contributions matter!</p>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="ftco-section ftco-no-pb" id="donate-homepage">
		<div class="container">
			<div class="row justify-content-center pb-5 mb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Our Causes</span>
					<h2>Donate to charity causes around Uganda</h2>
				</div>
			</div>
			<section class="ftco-section" style="margin-top: -50px;">
				<div class="container">
					<div class="row">
						<?php foreach ($campaigns as $campaign): ?>
							<div class="col-md-6 col-lg-3">
								<div class="causes causes-2 text-center ftco-animate card">
									<?php
									// Fetch the picture field (this will contain the image filename stored in the DB)
									$imagePath = htmlspecialchars($campaign['picture']);
									$imageDirectory = 'uploads/';
									$fullImagePath = $imageDirectory . $imagePath;
									$defaultImage = 'uploads/6787beda822ca.jpg';
									if (empty($imagePath) || !file_exists($fullImagePath)) {
										$fullImagePath = $defaultImage;
									}
									?>
									<!-- Dynamically set background image using the campaign's image URL -->
									<a href="#" class="img w-100" style="background-image: url('<?php echo $fullImagePath; ?>');"></a>
									<div class="text p-3">
										<h2><a href="#"><?php echo htmlspecialchars($campaign['campaign_title']); ?></a></h2>
										<p class="card-description"><?php echo htmlspecialchars($campaign['campaign_description']); ?></p>
										<div class="goal mb-4">
											<p><span id="amount-<?php echo $campaign['campaign_id']; ?>">$<?php echo number_format($campaign['expected_amount'], 2); ?></span> to go</p>
											<div class="progress" style="height: 20px">
												<div class="progress-bar progress-bar-striped" id="progress-bar-<?php echo $campaign['campaign_id']; ?>" data-campaign-id="<?php echo $campaign['campaign_id']; ?>" style="width: 0%; height: 20px">0%</div>
											</div>
										</div>
										<p>
											<a href="donate.php?campaign_id=<?php echo $campaign['campaign_id']; ?>&title=<?php echo urlencode($campaign['campaign_title']); ?>&description=<?php echo urlencode($campaign['campaign_description']); ?>&picture=<?php echo urlencode($campaign['picture']); ?>&expected_amount=<?php echo $campaign['expected_amount']; ?>" class="btn btn-light w-100">Donate Now</a>
										</p>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="text-center" style="margin-top: 30px;">
						<a href="causes.php#campaigns" class="btn btn-primary mt-6">See More Campaigns</a>
					</div>
				</div>

			</section>


		</div>

	</section>


	<!-- <div class="overlay"></div>

	</section> -->



	<section>
		<div>
			<p class="fundraise-account">For one to start a fundraise, you need to<a href="">Create your fundraise account</a></p> 
		</div>
	</section>

	<section class="ftco-hireme bg-secondary">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-md-8 col-lg-8 d-flex align-items-center">
					<div class="w-100">
						<h2>Best Way to Make a Difference in the Lives of Others</h2>
					</div>
				</div>
				<div class="col-md-4 col-lg-4 d-flex align-items-center justify-content-end">
					<p class="mb-0"><a href="index.php#donate-homepage" class="btn btn-primary py-3 px-4">Donate to a cause</a></p>
				</div>
			</div>
		</div>
	</section>


	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
					<h2 class="footer-heading">Help a Hand.</h2>
					<p>We provide a platform where anyone can create, manage, and promote their fundraising campaigns at no cost.</p>
					<ul class="ftco-footer-social p-0">
						<li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="fa fa-twitter"></span></a></li>
						<li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="fa fa-facebook"></span></a></li>
						<li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="fa fa-instagram"></span></a></li>
					</ul>


				</div>
				<div class="col-md-6 col-lg-3 pl-lg-5 mb-4 mb-md-0">
					<h2 class="footer-heading">Quick Links</h2>
					<ul class="list-unstyled">
						<li><a href="index.php" class="py-2 d-block">Home</a></li>
						<li><a href="fundraise.html #start-fundraise-section" class="py-2 d-block">Fundraise</a></li>
						<li><a href="index.php#donate-homepage" class="py-2 d-block">Donate</a></li>
						<li><a href="about.html" class="py-2 d-block">Causes</a></li>
						<li><a href="about.html" class="py-2 d-block">About</a></li>
						<li><a href="about.html" class="py-2 d-block">Contact</a></li>

					</ul>
				</div>
				<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
					<h2 class="footer-heading">Have a Questions?</h2>
					<div class="block-23 mb-3">
						<ul>
							<li><span class="icon fa fa-map"></span><span class="text">Kakebe Technologies Head Office, Plot 43 Lira - Soroti Rd, Lira</span></li>
							<li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+256 393249845</span></a></li>
							<li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">info@kakebetech.com</span></a></li>
						</ul>
					</div>
				</div>


				<div>
					<p><a href="index.php #donate-homepage" class="btn btn-quarternary" id="donate-now">Donate Now</a></p>
					<p><a href="fundraise.html #start-fundraise-section" class="btn btn-quarternary" id="start-fundraise-footer">start fundraise</a></p>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-md-12 text-center">

					<p class="copyright">
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved | HelpaHand</a>
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
	<script>
		// Function to update progress bars and amount to go every 5 seconds
		setInterval(function() {
			<?php foreach ($campaigns as $campaign): ?>
				// Make an AJAX request to get both the updated progress and remaining amount
				fetch('get_campaign_progress.php?campaign_id=<?php echo $campaign['campaign_id']; ?>')
					.then(response => response.json())
					.then(data => {
						// Check if data contains the necessary information
						if (data) {
							// Update the progress bar width and progress percentage
							const progressBar = document.getElementById('progress-bar-<?php echo $campaign['campaign_id']; ?>');
							const amountToGo = document.getElementById('amount-<?php echo $campaign['campaign_id']; ?>');

							if (data.progress !== undefined) {
								progressBar.style.width = data.progress + '%';
								progressBar.innerText = data.progress + '%';
							}

							// Update the remaining amount to go if available
							if (data.remaining_amount !== undefined) {
								amountToGo.innerText = "$" + data.remaining_amount.toFixed(2);
							}
						}
					})
					.catch(error => console.error('Error fetching progress:', error));
			<?php endforeach; ?>
		}, 5000); // Update progress every 5 seconds
	</script>
	<script src="js/index.js"></script>
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