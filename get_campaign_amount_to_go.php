<?php
include('php/config.php');

// Get campaign_id from the request
$campaign_id = $_GET['campaign_id'];

// Query to calculate the total donations for the given campaign
$query = "
    SELECT expected_amount - IFNULL(SUM(donation_amount), 0) AS amount_to_go
    FROM campaigns
    LEFT JOIN donations ON campaigns.campaign_id = donations.campaign_id
    WHERE campaigns.campaign_id = ?
";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $campaign_id);
    $stmt->execute();
    $stmt->bind_result($amount_to_go);
    $stmt->fetch();

    // Return the remaining amount in JSON format
    echo json_encode(['amount_to_go' => $amount_to_go]);
    $stmt->close();
} else {
    echo json_encode(['error' => 'Failed to fetch amount to go']);
}

// Close the database connection
$conn->close();
?>
