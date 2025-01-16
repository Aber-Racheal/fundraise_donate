<?php
// Include the database connection file
include('php/config.php');

// Query to get all campaigns
$sql = "SELECT * FROM campaigns ORDER BY created_at DESC"; // Ensure correct table name
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
    .payment-methods-section {
      padding: 50px 0;
      background-color: #f9f9f9;
    }

    .payment-method-icons img {
      margin: 0 10px;
      height: 50px;
    }

    #start-fundraise {
      background-color: #ffc107;
      border: #ffc107 solid 1px;
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
            <a href="#"><span class="fa fa-paper-plane mr-1"></span>
              helpahand@email.com</a>
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
          <li class="nav-item">
            <a href="index.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="fundraise.html" class="nav-link">Fundraise</a>
          </li>
          <li class="nav-item">
            <a href="donate.html" class="nav-link">Donate</a>
          </li>
          <li class="nav-item active cta">
            <a href="causes.html" class="nav-link">Causes</a>
          </li>
          <li class="nav-item">
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
            <span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span>
            <span>Causes <i class="ion-ios-arrow-forward"></i></span>
          </p>
          <h1 class="mb-0 bread">Causes</h1>
        </div>
      </div>
    </div>
  </section>

	<section class="ftco-section ftco-no-pb">
		<div class="container">
			<div class="row justify-content-center pb-5 mb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Our Causes</span>
					<h2>Donate to charity causes around Uganda</h2>
				</div>
			</div>
			<section class="ftco-section">
				<div class="container">
					<div class="row">
						<?php foreach ($campaigns as $campaign): ?>
							<div class="col-md-6 col-lg-3">
								<div class="causes causes-2 text-center ftco-animate">
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
										<p><?php echo htmlspecialchars($campaign['campaign_description']); ?></p>
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
				</div>
			</section>
		</div>
	</section>






  <section class="payment-methods-section">
    <div class="container text-center">
      <h2>Supported Payment Methods</h2>
      <div class="payment-method-icons">
        <img src="images/visa.png" alt="Visa" />
        <img src="images/mastercard.png" alt="Mastercard" />
        <img src="images/paypal.png" alt="PayPal" />
        <img src="images/bank-transfer.png" alt="Bank Transfer" />
      </div>
    </div>
  </section>

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
            <li><a href="index.html" class="py-2 d-block">Home</a></li>
            <li>
              <a href="fundraise.html" class="py-2 d-block">Fundraise</a>
            </li>
            <li><a href="donate.php" class="py-2 d-block">Donate</a></li>
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
                <span class="icon fa fa-map"></span><span class="text">Kakebe Technologies Head Office, Plot 43 Lira - Soroti Rd,
                  Lira</span>
              </li>
              <li>
                <a href="#"><span class="icon fa fa-phone"></span><span class="text"> +256 393249845</span></a>
              </li>
              <li>
                <a href="#"><span class="icon fa fa-paper-plane"></span><span class="text"> info@kakebetech.com</span></a>
              </li>
            </ul>
          </div>
        </div>

        <div>
          <p>
            <a href="donate.html" class="btn btn-quarternary" id="donate-now">Donate Now</a>
          </p>
          <p>
            <a
              href="fundraise.html"
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
  <div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
      <circle
        class="path-bg"
        cx="24"
        cy="24"
        r="22"
        fill="none"
        stroke-width="4"
        stroke="#eeeeee" />
      <circle
        class="path"
        cx="24"
        cy="24"
        r="22"
        fill="none"
        stroke-width="4"
        stroke-miterlimit="10"
        stroke="#F96D00" />
    </svg>
  </div>

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


  <script src="js/donate.js"></script>
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