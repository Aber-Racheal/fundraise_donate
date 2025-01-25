<?php
session_start();
?>
<?php
include('session.php')
?>
<?php
require_once '../php/config.php';
// Fetch all campaigns
$query = "SELECT campaign_id, campaign_title, campaign_description, picture FROM campaigns";
$result = mysqli_query($conn, $query);
$campaigns = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Campaigns</title>
    <link rel="stylesheet" href="css/logout-btn.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        .campaign-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
            transition: box-shadow 0.3s ease;
        }

        .campaign-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .campaign-card img {
            max-width: 100%;
            max-height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .campaign-card h4 {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .campaign-card p {
            font-size: 0.9rem;
            color: #555;
        }

        .campaign-card .btn {
            background-color: #2980b9;
            color: white;
            padding: 8px 18px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 0.9rem;
        }

        .campaign-card .btn:hover {
            background-color: #3498db;
        }

        /* Button container */
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-container .btn {
            padding: 8px 16px;
            font-size: 0.9rem;
            border-radius: 20px;
        }

        .btn-secondary,
        .btn-primary,
        .btn-danger {
            width: auto;
            margin-top: 10px;
        }

        .read-more {
            display: none;
            margin-top: 10px;
            text-decoration: none;
            color: #2980b9;
        }

        .card-content {
            max-height: 120px;
            overflow: hidden;
        }

        .card-footer {
            text-align: center;
            padding-top: 10px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .campaign-card {
                margin-bottom: 15px;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .campaign-card img {
                max-height: 120px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar (imported from sidebar.html) -->
        <?php include('sidebar.php'); ?>

        <!-- Main Content -->
        <div class="main-content">
            <h2>Your Campaigns</h2>

            <div class="d-flex flex-wrap">
                <?php foreach ($campaigns as $campaign): ?>
                    <div class="campaign-card col-12 col-md-6 col-lg-4">
                        <!-- Display Campaign Image -->
                        <img src="<?php echo 'uploads/' . $campaign['picture']; ?>" alt="Campaign Image">

                        <!-- Campaign Title -->
                        <h4><?php echo $campaign['campaign_title']; ?></h4>

                        <!-- Campaign Description (Limited and Show More option) -->
                        <div class="card-content">
                            <p class="campaign-description">
                                <?php
                                $desc = $campaign['campaign_description'];
                                if (strlen($desc) > 100) {
                                    echo substr($desc, 0, 100) . '... <a href="#" class="read-more" onclick="toggleDescription(this)">Read more</a>';
                                } else {
                                    echo $desc;
                                }
                                ?>
                            </p>
                        </div>

                        <div class="card-footer">
                            <!-- Center the buttons -->
                            <div class="btn-container">
                                <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#editCampaignModal" data-campaign-id="<?php echo $campaign['campaign_id']; ?>">Edit</a>
                                <a href="#" class="btn">End Campaign</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-4">
                <div class="btn-container">
                    <a href="causes.php #container" class="btn btn-secondary mb-2">See Other Campaigns</a>
                    <a href="causes.php #container" class="btn btn-primary mb-2">Start a Fundraise</a>
                    <a href="causes.php #container" class="btn btn-danger">Donate to a Cause</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Campaign Modal -->
    <div class="modal fade" id="editCampaignModal" tabindex="-1" aria-labelledby="editCampaignModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCampaignModalLabel">Edit Campaign</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="campaignImage" class="form-label">Campaign Image</label>
                        <img id="existingImage" src="" alt="Campaign Image" style="max-width: 100px; margin-bottom: 10px;">
                        <input type="file" class="form-control" id="campaignImage">
                    </div>
                    <div class="mb-3">
                        <label for="campaignTitle" class="form-label">Campaign Title</label>
                        <input type="text" class="form-control" id="campaignTitle" placeholder="Enter campaign title">
                    </div>
                    <div class="mb-3">
                        <label for="campaignDescription" class="form-label">Campaign Description</label>
                        <textarea class="form-control" id="campaignDescription" rows="3" placeholder="Enter campaign description"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary w-100" onclick="saveChanges()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle full description visibility
        function toggleDescription(element) {
            const p = element.closest('.campaign-description');
            p.classList.toggle('full-description');
            if (p.classList.contains('full-description')) {
                element.innerText = "Read less";
            } else {
                element.innerText = "Read more";
            }
        }

        // Modal handling for campaign editing
        const editButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const campaignId = this.getAttribute('data-campaign-id');
                fetch(`get_campaign_data.php?campaign_id=${campaignId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('campaignTitle').value = data.campaign_title;
                        document.getElementById('campaignDescription').value = data.campaign_description;
                        document.getElementById('existingImage').src = data.picture;
                    })
                    .catch(error => console.error('Error fetching campaign data:', error));
            });
        });

        function saveChanges() {
            const title = document.getElementById('campaignTitle').value;
            const description = document.getElementById('campaignDescription').value;
            const image = document.getElementById('campaignImage').files[0];

            const formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);
            if (image) formData.append('image', image);

            fetch('update_campaign.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => alert('Campaign updated successfully!'))
                .catch(error => console.error('Error updating campaign:', error));
        }
    </script>
</body>

</html>
