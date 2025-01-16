<?php
// Include the database connection file
include('php/config.php');

// Get the campaign_id from the request
$campaign_id = isset($_GET['campaign_id']) ? $_GET['campaign_id'] : 0;

// Fetch the total amount raised from the donations table for the current campaign
$sql = "SELECT SUM(donation_amount) AS total_donated FROM donations WHERE campaign_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $campaign_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Calculate the total amount raised
$total_donated = $row['total_donated'] ? $row['total_donated'] : 0;

// Fetch the expected amount from the campaigns table
$sql = "SELECT expected_amount FROM campaigns WHERE campaign_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $campaign_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$expected_amount = $row['expected_amount'] ? $row['expected_amount'] : 0;

// Calculate the progress percentage
$progress_percentage = 0;
if ($expected_amount > 0) {
    $progress_percentage = ($total_donated / $expected_amount) * 100;
}

// Return the data as JSON
echo json_encode([
    'total_donated' => number_format($total_donated, 2),
    'progress_percentage' => round($progress_percentage, 2)
]);

// Close the database connection
$stmt->close();
$conn->close();
?>
