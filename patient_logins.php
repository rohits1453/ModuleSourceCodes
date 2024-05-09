<?php
require("dbconn.php");

$response = array();

if (isset($_POST["mobile_number"])) {
    $mobileNumber = $_POST["mobile_number"];

    // Check if the mobile number exists in the database
    $check_sql = "SELECT `patient_mobile_number` FROM `patient_table` WHERE `patient_mobile_number` = '$mobileNumber'";
    $check_result = $conn->query($check_sql);

    if ($check_result && $check_result->num_rows > 0) {
        // Mobile number found
        $response['status'] = 'success';
        $response['message'] = 'Mobile number found';
    } else {
        // Mobile number not found
        $response['status'] = 'error';
        $response['message'] = 'Mobile number not found';
    }
} else {
    // Mobile number not provided
    $response['status'] = 'error';
    $response['message'] = 'Mobile number not provided';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
