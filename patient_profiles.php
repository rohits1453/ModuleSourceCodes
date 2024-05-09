<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include_once "dbconn.php";

    // Get the form data
    $patient_name = $_POST["patient_name"];
    $patient_mobile_number = $_POST["patient_mobile_number"];
    $patient_email = $_POST["patient_email"];
    $patient_password = $_POST["patient_password"];
    $patient_reenter_password = $_POST["patient_reenter_password"];

    // Check if patient with the same email already exists
    $check_query = "SELECT * FROM patient_table WHERE patient_email = '$patient_email'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "Patient with the same email already exists.";
    } else {
        // Insert the data into the database
        $insert_query = "INSERT INTO patient_table (patient_name, patient_mobile_number, patient_email, patient_password, patient_reenter_password) VALUES ('$patient_name', '$patient_mobile_number', '$patient_email', '$patient_password', '$patient_reenter_password')";
        if (mysqli_query($conn, $insert_query)) {
            echo "Record inserted successfully.";
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
