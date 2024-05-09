<?php
// Include the database connection file
require_once "dbconn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve data from the form
    $name = $_POST['editTextText5'];
    $age = $_POST['editTextText6'];
    $email = $_POST['editTextText7'];
    $mobileNumber = $_POST['editTextText8'];

    // Perform your database insertion here
    $sql = "INSERT INTO patient_table (patient_name, patient_age, patient_email, patient_mobile_number) 
            VALUES ('$name', '$age', '$email', '$mobileNumber')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
