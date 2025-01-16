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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
    max-width: 300px; /* Limit the image width to 600px */
    height: auto;     /* Maintain the aspect ratio */
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin: 0 auto;   /* Center the image */
    display: block;   /* Ensure the image is block-level to center it */
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

        .form-control, .form-select {
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
<body>
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

                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">SELECT PAYMENT METHOD</label>
                        <select class="form-select" id="paymentMethod" required>
                            <option value="">Choose...</option>
                            <option value="stripe">Credit/Debit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="bank">Bank Transfer</option>
                        </select>
                    </div>

                    <div id="paymentDetails" class="mt-3"></div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">DONATE NOW</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
        setInterval(fetchProgress, 5000);

        // Fetch initial progress when the page loads
        fetchProgress();

        // Dynamic Payment Method Fields (Same as before)
        document.getElementById("paymentMethod").addEventListener("change", function () {
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
        document.getElementById("donationForm").addEventListener("submit", function (event) {
            event.preventDefault();
            const donationAmount = document.getElementById("donationAmount").value;
            // Show success modal or handle donation logic here
        });



        document.getElementById("paymentMethod").addEventListener("change", function () {
    const paymentDetails = document.getElementById("paymentDetails");
    paymentDetails.innerHTML = ""; // Clear previous fields
    
    const selectedMethod = this.value;
    
    if (selectedMethod === "stripe") {
        paymentDetails.innerHTML = `
            <div class="mb-3">
                <label for="stripeCardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="stripeCardNumber" placeholder="Enter your card number" required>
            </div>
            <div class="mb-3">
                <label for="stripeExpiryDate" class="form-label">Expiry Date</label>
                <input type="text" class="form-control" id="stripeExpiryDate" placeholder="MM/YY" required>
            </div>
            <div class="mb-3">
                <label for="stripeCVV" class="form-label">CVV</label>
                <input type="text" class="form-control" id="stripeCVV" placeholder="Enter CVV" required>
            </div>
        `;
    } else if (selectedMethod === "paypal") {
        paymentDetails.innerHTML = `
            <div class="mb-3">
                <label for="paypalEmail" class="form-label">PayPal Email</label>
                <input type="email" class="form-control" id="paypalEmail" placeholder="Enter your PayPal email" required>
            </div>
        `;
    } else if (selectedMethod === "bank") {
        paymentDetails.innerHTML = `
            <div class="mb-3">
                <label for="bankAccountNumber" class="form-label">Bank Account Number</label>
                <input type="text" class="form-control" id="bankAccountNumber" placeholder="Enter your bank account number" required>
            </div>
            <div class="mb-3">
                <label for="bankRoutingNumber" class="form-label">Bank Routing Number</label>
                <input type="text" class="form-control" id="bankRoutingNumber" placeholder="Enter your routing number" required>
            </div>
        `;
    }
});

    </script>
</body>
</html>
