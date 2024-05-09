<?php
// Include the database connection file
require_once "dbconn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Decode the JSON data
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if all required fields are present
    if (
        isset($data['editTextName']) && 
        isset($data['editTextMobileNumber']) && 
        isset($data['editTextEmail']) && 
        isset($data['editTextChangePassword']) && 
        isset($data['editTextReenterPassword'])
    ) {
        // Retrieve data from the JSON
        $name = $data['editTextName'];
        $mobileNumber = $data['editTextMobileNumber'];
        $email = $data['editTextEmail'];
        $password = $data['editTextChangePassword'];
        $reenterPassword = $data['editTextReenterPassword'];

        // Perform your database insertion here
        // Replace 'password' with the correct column name in your database
        $sql = "INSERT INTO patient_table (patient_name, patient_mobile_number, patient_email, patient_password, patient_reenter_password) 
                VALUES ('$name', '$mobileNumber', '$email', '$password', '$reenterPassword')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Required fields are missing
        echo "Please fill in all required fields.";
    }
}

// Close the connection
$conn->close();
?>
