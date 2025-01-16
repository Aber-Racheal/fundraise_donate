<?php
// Include the database connection
include('php/config.php');

// Get campaign ID from the request
$campaign_id = isset($_GET['campaign_id']) ? (int) $_GET['campaign_id'] : 0;

// Check if the campaign_id is valid
if ($campaign_id <= 0) {
    echo json_encode([
        'error' => 'Invalid campaign ID'
    ]);
    exit;
}

// Query to get the total donations for the campaign
$sql = "SELECT SUM(donation_amount) AS total_donated FROM donations WHERE campaign_id = $campaign_id";
$result = $conn->query($sql);

// Check for database query errors
if ($result) {
    $data = $result->fetch_assoc();
    $total_donated = $data['total_donated'] ?? 0;

    // Fetch expected amount for the campaign
    $sql = "SELECT expected_amount FROM campaigns WHERE campaign_id = $campaign_id";
    $result = $conn->query($sql);
    
    // Ensure the campaign exists
    if ($result && $campaign = $result->fetch_assoc()) {
        $expected_amount = $campaign['expected_amount'];

        // Calculate progress as a percentage
        $progress = ($expected_amount > 0) ? ($total_donated / $expected_amount) * 100 : 0;

        // Calculate remaining amount
        $remaining_amount = $expected_amount - $total_donated;

        // Return progress, total donated, remaining amount, and expected amount as JSON
        echo json_encode([
            'progress' => round($progress, 2),
            'total_donated' => round($total_donated, 2),
            'remaining_amount' => round($remaining_amount, 2),
            'expected_amount' => $expected_amount
        ]);
    } else {
        echo json_encode([
            'error' => 'Campaign not found'
        ]);
    }
} else {
    echo json_encode([
        'error' => 'Error fetching total donations'
    ]);
}

// Close the database connection
$conn->close();
?>
