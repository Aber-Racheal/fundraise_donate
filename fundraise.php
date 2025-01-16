<?php
// Include the database connection file
include('php/config.php');

// Process form submission
$response = array('success' => false, 'error' => ''); // Default response

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file is uploaded
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $fileTmpPath = $_FILES['picture']['tmp_name'];
        $fileName = $_FILES['picture']['name'];
        $fileSize = $_FILES['picture']['size'];
        $fileType = $_FILES['picture']['type'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allowed file types
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        // Check if the uploaded file has a valid extension
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            // Generate a unique name for the file to avoid conflicts
            $newFileName = uniqid() . '.' . $fileExtension;
            $uploadDir = 'uploads/'; // Directory to store the uploaded images
            $uploadPath = $uploadDir . $newFileName;

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                // File upload successful, now handle the form data (description and expected amount)
                $campaignTitle = $_POST['campaign_title'];
                $campaignDescription = $_POST['campaign_description'];
                $expectedAmount = $_POST['expected_amount'];
                $createdAt = date('Y-m-d H:i:s'); // Get the current timestamp for created_at

                // Insert data into the campaigns table
                $sql = "INSERT INTO campaigns (picture, campaign_description, expected_amount, created_at, campaign_title) 
                        VALUES (?, ?, ?, ?, ?)";

                if ($stmt = $conn->prepare($sql)) {
                    // Bind form data to the prepared statement
                    $stmt->bind_param("sssss", $newFileName, $campaignDescription, $expectedAmount, $createdAt,  $campaignTitle);

                    // Execute the query
                    if ($stmt->execute()) {
                        $response['success'] = true; // Set success to true
                    } else {
                        $response['error'] = "Error inserting campaign: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    $response['error'] = "Error preparing the query: " . $conn->error;
                }
            } else {
                $response['error'] = "Error moving the uploaded file.";
            }
        } else {
            $response['error'] = "Invalid file type. Only JPG, JPEG, PNG files are allowed.";
        }
    } else {
        $response['error'] = "No file uploaded or file upload error.";
    }
}

echo json_encode($response); // Return JSON response
?>
