<?php
require "dbconn.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file was uploaded without errors
    if (isset($_FILES["profile_photo"]) && $_FILES["profile_photo"]["error"] == 0) {
        // Define the target directory where the file will be uploaded
        $target_dir = "D:/Xampp/htdocs/uploads/"; // Update with the correct absolute path
        $target_file = $target_dir . uniqid() . "_" . basename($_FILES["profile_photo"]["name"]);

        // Check if the file is an image
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowedExtensions)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
                // Insert the file path into the database or use it as needed
                $profile_photo_path = $target_file;

                // You can now use $profile_photo_path in your database insert/update logic
                // For example, you can insert it into the 'profile_photos' column in a user table
                // $sql = "INSERT INTO users (username, profile_photo) VALUES ('$username', '$profile_photo_path')";

                $response = array('status' => 'success', 'message' => 'Profile photo uploaded successfully');
            } else {
                $response = array('status' => 'error', 'message' => 'Sorry, there was an error uploading your profile photo.');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Sorry, only JPG, JPEG, PNG, and GIF files are allowed for profile photos.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'No profile photo was uploaded.');
    }
}

// Set JSON headers
header('Content-Type: application/json');

// Convert response to JSON and echo it
echo json_encode($response);

// Close connection
$conn->close();
?>
