<?php
// Include the database connection file
include_once "dbconn.php";

// Perform the query to get patient details
$query = "SELECT `patient_name`, `patient_mobile_number`, `patient_email`, `patient_password`, `patient_reenter_password` FROM `patient_table` WHERE 1";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    $patients = array();
    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Add the patient details to the patients array
        $patients[] = $row;
    }
    // Close the result set
    mysqli_free_result($result);

    // Close the database connection
    mysqli_close($conn);

    // Return the patients array as a JSON response
    echo json_encode($patients);
} else {
    // Return an error message if the query fails
    echo json_encode(array("message" => "Error retrieving patients: " . mysqli_error($conn)));
}
?>
