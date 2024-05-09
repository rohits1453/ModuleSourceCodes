<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include_once "dbconn.php";

    // Get the form data if the keys exist
    $patient_name = isset($_POST["patient_name"]) ? $_POST["patient_name"] : "";
    $patient_age = isset($_POST["patient_age"]) ? $_POST["patient_age"] : "";
    $patient_email = isset($_POST["patient_email"]) ? $_POST["patient_email"] : "";
    $patient_mobile_number = isset($_POST["patient_mobile_number"]) ? $_POST["patient_mobile_number"] : "";
    $patient_id = isset($_POST["patient_id"]) ? $_POST["patient_id"] : "";

    // Check if all required keys are set
    if ($patient_name && $patient_age && $patient_email && $patient_mobile_number && $patient_id) {
        // Check if patient data already exists
        $check_query = "SELECT * FROM patient_table WHERE patient_name = '$patient_name' AND patient_age = '$patient_age' AND patient_email = '$patient_email' AND patient_mobile_number = '$patient_mobile_number'";
        $result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($result) > 0) {
            // Update the existing record
            $update_query = "UPDATE patient_table SET patient_name = '$patient_name', patient_age = '$patient_age', patient_email = '$patient_email', patient_mobile_number = '$patient_mobile_number' WHERE patient_id = '$patient_id'";
            if (mysqli_query($conn, $update_query)) {
                echo "Record updated successfully.";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Add the Patient Data First";
        }
    } else {
        echo "Missing required data";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
