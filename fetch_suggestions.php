<?php
// Include the database connection file
include('php/config.php');

// Get the search term from the URL
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Ensure the search term is at least 3 characters long
if (strlen($searchTerm) < 3) {
    echo json_encode([]); // Return empty array if search term is too short
    exit;
}

// Modify the SQL query to search by campaign title or description
$sql = "SELECT campaign_title FROM campaigns WHERE campaign_title LIKE ? ORDER BY created_at DESC LIMIT 5";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$searchTermWithWildcard = "%" . $searchTerm . "%";
$stmt->bind_param("s", $searchTermWithWildcard);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Fetch results into an array
$suggestions = [];
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row;
}

// Return the suggestions as JSON
echo json_encode($suggestions);

// Close the database connection
$conn->close();
?>
